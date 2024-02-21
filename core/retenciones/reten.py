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
                        AND UltimoCambio >= '2024-01-01'
                        AND UltimoCambio <= '2024-01-02'
                        AND eMail1 NOT IN('panamakim@hotmail.com', 'mario66768@hotmail.com')
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
    ruc_proveedor = row.RUCProveedor.replace(" ", "_")
    documento = row.Documento.replace(" ", "_").replace("/", "_").replace("\\", "_")  # Asegurar nombres de archivo válidos
    
    # Construye el directorio principal
    directory = os.path.join(".", f"{ruc_proveedor}")
    if not os.path.exists(directory):
        os.makedirs(directory)
    
    pdf_file_name = f"{documento}.pdf"
    pdf_file_path = os.path.join(directory, pdf_file_name)
    c = canvas.Canvas(pdf_file_path)
    
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
    
    print(f"Guardando archivo en: {pdf_file_path}")
    c.save()
    
    # Comprimir la carpeta
    zipf = zipfile.ZipFile(f'{directory}.zip', 'w', zipfile.ZIP_DEFLATED)
    zipdir(directory, zipf)
    zipf.close()
    
    #email = row.eMail1 # mail de produccion 
    email = "pedro.arrieta@grupopcr.com.pa"  # Email de prueba
    if email is None:
        print("Registro sin correo electrónico, saltando...")
        continue  # Saltar este registro y continuar con el sig
    
    if email not in email_groups:
        email_groups[email] = []
    email_groups[email].append(f'{directory}.zip')

n = 0
for email, files in email_groups.items():
    
    if n >= 1:
        continue
    
    zip_file_path = f"./{email.replace('@', '_').replace('.', '_')}.zip"
    with zipfile.ZipFile(zip_file_path, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for file_path in files:
            zipf.write(file_path, os.path.basename(file_path))    
    
    
    subject = "Retenciones"
    body = "Retenciones"
    msg = EmailMessage()
    msg["From"] = "notificaciones1@grupopcr.com.pa"
    msg["To"] = email
    msg["Subject"] = subject
    msg.set_content(body)
    
    for file_path in files:
        # Obtiene el tamaño del archivo en bytes
        file_size = os.path.getsize(file_path)
        # Convierte el tamaño del archivo a megabytes (MB)
        file_size_mb = file_size / (1024 * 1024)
        print(f"Preparando para adjuntar: {os.path.basename(file_path)} de tamaño: {file_size_mb:.2f} MB")
        
        if file_size_mb > 30:  # Asumiendo un límite de 25MB, ajusta según sea necesario
                print(f"El archivo {os.path.basename(file_path)} excede el tamaño máximo permitido y no será enviado.")
                continue  # Salta este archivo

        with open(zip_file_path, 'rb') as file:
            msg.add_attachment(file.read(), maintype='application', subtype='octet-stream', filename=os.path.basename(zip_file_path))
    
        # Usar SMTP para enviar el correo
    try:
        # Usar SMTP para enviar el correo
        with smtplib.SMTP('smtp-mail.outlook.com', 587) as smtp:
            smtp.ehlo()
            smtp.starttls()
            smtp.ehlo()
            smtp.login("notificaciones1@grupopcr.com.pa", "Chicho1787$$$")
            smtp.send_message(msg)
            print(f"Correo enviado a: {email}")
            
            n = n + 1
    except smtplib.SMTPSenderRefused as e:
        print(f"No se pudo enviar el correo a {email}: {e}")

        print(f"Correo enviado a: {email}")

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

# mandar pagina web