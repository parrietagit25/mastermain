import os
import pyodbc
from reportlab.pdfgen import canvas
import zipfile
import smtplib
from email.message import EmailMessage
import shutil
import time

conn_str = (
    'DRIVER={ODBC Driver 17 for SQL Server};'
    'SERVER=10.10.2.25;'
    'DATABASE=PCR;'
    'Trusted_Connection=yes;' 
)
conn = pyodbc.connect(conn_str)

cursor = conn.cursor()

cursor.execute("""SELECT
                    [Empresa],
                    [Documento],
                    [FechaCreacion],
                    [DVProveedor],
                    [RUCProveedor],
                    [RegistroPatronal],
                    [RFC],
                    [Nombre],
                    [Mov],
                    [UltimoCambio],
                    [Monto],
                    [MontoSujeto],
                    [MontoRetenido],
                    [eMail1]
                FROM [dbo].[MovimientoRetencionITBMC]
                WHERE [Mov] ='Retencion ITBMS'
                    AND (NOT ([MontoRetenido] = '0.00') )
                    AND convert(date,UltimoCambio)=convert(date,GETDATE())
                    Order by RUCProveedor desc""")

def zipdir(path, ziph):
    # ziph es el objeto zipfile
    for root, dirs, files in os.walk(path):
        for file in files:
            ziph.write(os.path.join(root, file), 
                       os.path.relpath(os.path.join(root, file), 
                                       os.path.join(path, '..')))

email_groups = {}

for row in cursor:
    #ruc_proveedor = row.RUCProveedor
    ruc_proveedor = row.RUCProveedor.replace(" ", "_")
    directory = f"./{ruc_proveedor}"
    if not os.path.exists(directory):
        os.makedirs(directory)   
    
    documento = row.Documento.replace(" ", "_")

    pdf_file = f"{directory}/{documento}.pdf"
    c = canvas.Canvas(pdf_file)
    
    texto = "Tu texto aquí"
    fuente = "Helvetica"
    tamano_fuente = 12
    c.setFont(fuente, tamano_fuente)
    ancho_texto = c.stringWidth(texto, fuente, tamano_fuente)
    
    c.drawString(300, 770, "PANAMA CAR RENTAL, S.A")
    c.drawString(250, 755, "CETIFICADO DE RETENCION EN LA FUENTE")
    c.drawImage('logo.jpg', 0, 720, 200, 80)
    c.drawString(400, 705, f"Documento : {row.Documento}")
    c.drawString(400, 690, "Estado : Recibido")
    c.drawString(400, 675, f"Fecha : {row.FechaCreacion}")
    
    c.drawString(10, 620, f"Fecha : {row.FechaCreacion}")
    
    c.drawString(10, 605, "Retenciones en la fuente practicada por:")
    c.drawString(20, 590, f"R.U.C: {row.RFC}")
    c.drawString(200, 590, f"Nombre: {row.Empresa}")
    c.drawString(450, 590, f"{row.RegistroPatronal}")
    
    c.drawString(10, 550, "Retenciones practicadas a:")
    c.drawString(20, 535, f"R.U.C: {row.RUCProveedor}")
    c.drawString(200, 535, f"Nombre: {row.Nombre}")
    c.drawString(450, 535, f"DV: {row.DVProveedor}")
    
    c.drawString(10, 410, "Tipo de Retención")
    c.drawString(140, 410, "Fecha Pago")
    c.drawString(240, 410, "Monto")
    c.drawString(290, 410, "Monto Sujeto Retención")
    c.drawString(440, 410, "Monto Retenido")
    c.drawString(10, 395, "Retencion ITBMS")
    c.drawString(140, 395, " ")
    c.drawString(240, 395, f" {row.Monto}")
    c.drawString(300, 395, f" {row.MontoSujeto}")
    c.drawString(440, 395, f" {row.MontoRetenido}")
    
    c.drawString(10, 370, f"Fecha de creacion: {row.FechaCreacion}")
    
    # dibujar el cuadro
    
    x = 5
    y = 660
    
    padding = 2
    x_rect = 2.5
    y_rect = 350
    ancho_rect = 580
    alto_rect = 290
    
    c.rect(x_rect, y_rect, ancho_rect, alto_rect)
    
    c.save()
    
    # Comprimir la carpeta
    zipf = zipfile.ZipFile(f'{directory}.zip', 'w', zipfile.ZIP_DEFLATED)
    zipdir(directory, zipf)
    zipf.close()
    
    #email = row.eMail1
    email = "tayronperez17@gmail.com"  # Email de prueba
    if email not in email_groups:
        email_groups[email] = []
    email_groups[email].append(f'{directory}.zip')

for email, files in email_groups.items():
    subject = "Retenciones"
    body = "Retenciones"

    msg = EmailMessage()
    msg["From"] = "notificaciones1@grupopcr.com.pa"
    msg["To"] = email
    msg["Subject"] = subject
    msg.set_content(body)

    for file_path in files:
        with open(file_path, 'rb') as file:
            msg.add_attachment(file.read(), maintype='application', subtype='octet-stream', filename=os.path.basename(file_path))

    # Usar SMTP con STARTTLS
    with smtplib.SMTP('smtp-mail.outlook.com', 587) as smtp:
        smtp.ehlo()  # Identificar al servidor
        smtp.starttls()  # Iniciar modo TLS
        smtp.ehlo()  # Identificar de nuevo al servidor en modo TLS
        smtp.login("notificaciones1@grupopcr.com.pa", "Dollar2023.")
        smtp.send_message(msg)

def eliminar_carpetas_y_rar(directorio):
    for nombre in os.listdir(directorio):
        camino = os.path.join(directorio, nombre)
        try:
            if os.path.isdir(camino):
                shutil.rmtree(camino)
            elif os.path.isfile(camino) and (camino.lower().endswith('.rar') or camino.lower().endswith('.zip')):
                os.remove(camino)
        except PermissionError as e:
            print(f"No se pudo eliminar {camino}: {e}")
        except Exception as e:
            print(f"Error al eliminar {camino}: {e}")
            
directorio_especifico = os.path.dirname(os.path.realpath(__file__))
eliminar_carpetas_y_rar(directorio_especifico)
      
cursor.close()
conn.close()