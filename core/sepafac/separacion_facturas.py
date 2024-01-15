import subprocess

print("procesando...")

# Ejecutar el primer script que pasa descomprimir los archivos comprimidos y tratar las facturas
subprocess.run(["python", "descomprimir.py"])

# Ejecutar el segundo script que separa y organiza las facturas en carpetas
subprocess.run(["python", "separacion.py"])