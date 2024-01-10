import http.client
import os
import shutil
import json

print("El proceso de separacion ha iniciado ...")

conn = http.client.HTTPSConnection("cq1e.barscloud.com", 612)
headers = {
    'Cookie': 'cq_allow_progress=yes; CQCSBROWSEID=164740172199270939; CQCSID=InQd3BHh6cxe6pwOl2JynQ##'
}
conn.request("GET", "/dolPanamaRW/queryapi/apiSeparacion.mf?dtsdate=2016-01-01", '', headers)
res = conn.getresponse()
data = res.read()
datos = json.loads(data.decode("utf-8"))

resultados = datos['data']

mapeo_ranumber_company = {item['ranumber']: item['company'] for item in resultados if 'ranumber' in item and 'company' in item}
directorio_archivos = 'f_sinseparar/extracted_files/'

directorio_retail = os.path.join(directorio_archivos, "Retail")
directorio_rollover = os.path.join(directorio_archivos, "Rollover")
os.makedirs(directorio_retail, exist_ok=True)
os.makedirs(directorio_rollover, exist_ok=True)

for archivo in os.listdir(directorio_archivos):
    if archivo.endswith('.pdf'):
        numero_archivo = ''
        if archivo.startswith('RA-'):
            # Caso Retail
            numero_archivo = archivo.split('-')[1].split('.')[0]
        elif archivo.startswith('Rollover_'):
            # Caso Rollover
            numero_archivo = archivo.split('_')[1]

        company_correspondiente = mapeo_ranumber_company.get(numero_archivo)
        if company_correspondiente:
            if 'Rollover_' in archivo:
                directorio_destino = os.path.join(directorio_rollover, company_correspondiente)
            else:
                directorio_destino = os.path.join(directorio_retail, company_correspondiente)
            
            os.makedirs(directorio_destino, exist_ok=True)
            shutil.move(os.path.join(directorio_archivos, archivo), os.path.join(directorio_destino, archivo))
            
print("El proceso de separacion ha terminado :)")
print("Por favor verificar la carpeta compartida")
