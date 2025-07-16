"""
from flask import Flask, request, jsonify
from reportlab.pdfgen import canvas
import pyodbc
import zipfile
import smtplib
from email.message import EmailMessage
import shutil
import os
import sys
import time
"""

print('Entro al py')
"""
app = Flask(__name__)

@app.route('/generate_report', methods=['POST'])
def generate_report():
    data = request.get_json()
    fecha_inicio = data.get('fecha_inicio')
    fecha_fin = data.get('fecha_fin')
    ruc_prov = data.get('ruc_prov')

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
    n = 0
    pdf_files = []

    for row in cursor:
        n += 1
        ruc_proveedor = row.RUCProveedor.replace(" ", "_")
        documento = row.Documento.replace(" ", "_").replace("/", "_").replace("\\", "_")

        directory = os.path.join(".", f"{ruc_proveedor}")
        if not os.path.exists(directory):
            os.makedirs(directory)
        
        pdf_file_name = f"{documento}_{n}.pdf"
        pdf_file_path = os.path.join(directory, pdf_file_name)
        pdf_files.append(pdf_file_path)  # Agregar el archivo PDF a la lista
        c = canvas.Canvas(pdf_file_path)

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
        
        c.rect(2.5, 350, 580, 290)

        print(f"Guardando archivo en: {pdf_file_path}")
        c.save()

        email = row.eMail1
        if email is None:
            print("Registro sin correo electrónico, saltando...")
            continue

        if email not in email_groups:
            email_groups[email] = []
        email_groups[email].append(pdf_file_path)

    for email, files in email_groups.items():
        directory = os.path.join(".", "temp")
        if not os.path.exists(directory):
            os.makedirs(directory)

        zip_file_path = os.path.join(directory, f"{ruc_prov}.zip")
        with zipfile.ZipFile(zip_file_path, 'w', zipfile.ZIP_DEFLATED) as zipf:
            for file_path in files:
                zipf.write(file_path, os.path.basename(file_path))
        
        #email = "pedroarrieta25@hotmail.com"
        msg = EmailMessage()
        msg["From"] = "notificaciones@grupopcr.com.pa"
        msg["To"] = "pedroarrieta25@hotmail.com" 
        #email
        msg["Subject"] = "Retenciones"
        msg.set_content("Se anexa reporte de retenciones enviadas.")

        with open(zip_file_path, 'rb') as f:
            msg.add_attachment(f.read(), maintype='application', subtype='zip', filename=os.path.basename(zip_file_path))

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
    return jsonify({"message": "Proceso de envio de retenciones terminado"})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
    """
