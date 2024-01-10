import os
import rarfile
import zipfile

print("El proceso de descomprimir ha iniciado ...")

rarfile.UNRAR_TOOL = 'C:\\unrar.exe'

def extraer_archivos(archivo, directorio_destino):
    if archivo.endswith('.zip'):
        with zipfile.ZipFile(archivo, 'r') as zip_ref:
            zip_ref.extractall(directorio_destino)
    elif archivo.endswith('.rar'):
        with rarfile.RarFile(archivo) as rar_ref:
            rar_ref.extractall(directorio_destino)

    # Eliminar el archivo comprimido después de extraer
    os.remove(archivo)

def iterar_archivos(directorio):
    if not os.path.exists(directorio):
        print(f"El directorio {directorio} no existe.")
        return

    for nombre in os.listdir(directorio):
        ruta_completa = os.path.join(directorio, nombre)

        if os.path.isfile(ruta_completa) and (ruta_completa.endswith('.zip') or ruta_completa.endswith('.rar')):
            directorio_destino = os.path.join(directorio, 'extracted_files')
            extraer_archivos(ruta_completa, directorio_destino)
            iterar_archivos(directorio_destino)
        elif os.path.isdir(ruta_completa):
            print("Directorio:", ruta_completa)
            iterar_archivos(ruta_completa)

directorio_a_explorar = 'f_sinseparar/'
iterar_archivos(directorio_a_explorar)

print("El proceso de descomprimir termino, inicia el proceso de separacion")

