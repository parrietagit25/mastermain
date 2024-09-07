import pyodbc
import mysql.connector

# SQL Server
conn_sql = pyodbc.connect('DRIVER={ODBC Driver 17 for SQL Server};SERVER=10.10.2.25;DATABASE=PCR;UID=Pcrdwh;PWD=dPcrdwhV646!$W')
cursor_sql = conn_sql.cursor()

# MySQL
config_mysql = {
    'user': 'root',
    'password': 'elchamo1787$$$',
    'host': 'localhost',
    'database': 'mastermain'
}

cursor_sql.execute("SELECT count(*) as contar FROM Prov")
sql_rec = cursor_sql.fetchone()[0]

try:
    conn_mysql = mysql.connector.connect(**config_mysql)
    cursor_mysql = conn_mysql.cursor()

    cursor_mysql.execute("SELECT count(*) as contar FROM proveedores")
    mysq_rec = cursor_mysql.fetchone()[0]

    if sql_rec > mysq_rec:
        cursor_mysql.execute("DELETE FROM proveedores")
        conn_mysql.commit()

        cursor_sql.execute("SELECT RUC, Proveedor, Nombre FROM Prov")
        rows_sql = cursor_sql.fetchall()

        insert_query = "INSERT INTO proveedores (RUC, Proveedor, Nombre) VALUES (%s, %s, %s)"
        
        for row in rows_sql:
            ruc = row.RUC
            prov = row.Proveedor
            nomb = row.Nombre
            cursor_mysql.execute(insert_query, (ruc, prov, nomb))

        conn_mysql.commit()
        print(f"Se han insertado {cursor_mysql.rowcount} registros en MySQL.")

except mysql.connector.Error as err:
    print(f"Error: {err}")
    if conn_mysql:
        conn_mysql.rollback()
finally:
    if cursor_sql:
        cursor_sql.close()
    if conn_sql:
        conn_sql.close()
    if cursor_mysql:
        cursor_mysql.close()
    if conn_mysql:
        conn_mysql.close()
