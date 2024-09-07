import sys
import os

# Agregar explícitamente la ruta de instalación de reportlab al sys.path
sys.path.append('C:\\Users\\administracion\\AppData\\Roaming\\Python\\Python311\\site-packages')

try:
    from reportlab.pdfgen import canvas
    print("Reportlab importado correctamente")
except ImportError as e:
    print(f"Error al importar reportlab: {e}")
    sys.exit(1)

import pyodbc
import zipfile
import smtplib
from email.message import EmailMessage
import shutil
import time

def main():
    if len(sys.argv) != 4:
        print("Uso: python reten.py <fecha_inicio> <fecha_fin> <ruc_prov>")
        return

    fecha_inicio = sys.argv[1]
    fecha_fin = sys.argv[2]
    ruc_prov = sys.argv[3]

    print(f"Fecha inicio: {fecha_inicio}")
    print(f"Fecha fin: {fecha_fin}")
    print(f"RUC Proveedor: {ruc_prov}")

    conn = pyodbc.connect('DRIVER={ODBC Driver 17 for SQL Server};SERVER=10.10.2.25;DATABASE=PCR;UID=Pcrdwh;PWD=dPcrdwhV646!$W')
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
                    WHERE [Mov] = N'Retencion ITBMS'
                        AND (NOT ([MontoRetenido] = N'0.00') )
                        AND ([UltimoCambio] >= ? AND [UltimoCambio] <= ?)
                        AND eMail1 IS NOT NULL 
                        AND eMail1 != ''
                        AND RUCProveedor = ?
                        GROUP BY
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
                        [eMail1]""", (fecha_inicio, fecha_fin, ruc_prov))


    def zipdir(path, ziph):
        for root, dirs, files in os.walk(path):
            for file in files:
                ziph.write(os.path.join(root, file), 
                        os.path.relpath(os.path.join(root, file), 
                                        os.path.join(path, '..')))

    email_groups = {}

    n=0

    for row in cursor:
        int(n)
        n = n + 1 
        ruc_proveedor = row.RUCProveedor.replace(" ", "_")
        documento = row.Documento.replace(" ", "_").replace("/", "_").replace("\\", "_")  # Asegurar nombres de archivo válidos
        
        # directorio principal
        directory = os.path.join(".", f"{ruc_proveedor}")
        if not os.path.exists(directory):
            os.makedirs(directory)
        
        pdf_file_name = f"{documento}_" + str(n) + ".pdf"
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
        
        email = "pedroarrieta25@hotmail.com"
        if email is None:
            print("Registro sin correo electrónico, saltando...")
            continue
        
        if email not in email_groups:
            email_groups[email] = []
        email_groups[email].append(f'{directory}.zip')

    n = 0
    for email, files in email_groups.items():

        print(email)
        email = "pedroarrieta25@hotmail.com"
        msg = EmailMessage()
        msg["From"] = "notificaciones@grupopcr.com.pa"
        msg["To"] = email
        msg["Subject"] = "Retenciones"
        msg.set_content("Se anexa reporte de retenciones enviadas.")

        for file_path in files:
            if n >= 1:
                continue
            n = n + 1
            if os.path.getsize(file_path) < 25 * 1024 * 1024:  # Límite de tamaño de archivo
                with open(file_path, 'rb') as f:
                    msg.add_attachment(f.read(), maintype='application', subtype='zip', filename=os.path.basename(file_path))

        try:
            with smtplib.SMTP('smtp-mail.outlook.com', 587) as smtp:
                smtp.ehlo()
                smtp.starttls()
                smtp.login("notificaciones@grupopcr.com.pa", "ghhpsqstqbfyscpc")
                smtp.send_message(msg)
                print(f"Correo enviado a: {email}")
        except Exception as e:
            print(f"No se pudo enviar el correo a {email}: {e}")

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
    print("Proceso de envio de retenciones terminado")

if __name__ == "__main__":
    main()
