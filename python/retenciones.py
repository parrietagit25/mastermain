import sys
import os
import pyodbc
import smtplib
import shutil
import time
#from reportlab.pdfgen import canvas

def main():
    # sys.argv contiene los argumentos pasados al script
    param1 = sys.argv[1]
    param2 = sys.argv[2]
    param3 = sys.argv[3]
    
    fecha_inicio = param1
    fecha_fin = param2
    ruc = param3
    ruc_for = ruc.split(' ')
    params = (fecha_inicio, fecha_fin, ruc_for[0])

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
                        [eMail1]""", params)

    for row in cursor:
        print("{} {} {} {} {} {} {} {} {} {} {} {} {} {}\n".format(
            row.Empresa,
            row.Documento,
            row.FechaCreacion,
            row.DVProveedor,
            row.RUCProveedor,
            row.RegistroPatronal,
            row.RFC,
            row.Nombre,
            row.Mov,
            row.UltimoCambio,
            row.Monto,
            row.MontoSujeto,
            row.MontoRetenido,
            row.eMail1
        ))
        print("------------------------------------------------------------------------------------------\n")

if __name__ == "__main__":
    main()

