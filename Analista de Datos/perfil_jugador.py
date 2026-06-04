#Importamos el archivo: configuracion
import configuracion as conf

def obtener_puuid(game_name, tag_line):
    """
    Busca a un jugador por su Riot ID y devuelve su PUUID.
    """
    #Construye la URL usando la plantilla de cuentas (region global/Americas)
    url = f"{conf.URL_CUENTAS}/account/v1/accounts/by-riot-id/{game_name}/{tag_line}"
    
    #Realiza la peticion usando la funcion de conexion del archivo de configuracion
    datos = conf.conexion_riot(url)
    
    #Si la API responde con exito, extrae y devuelve el PUUID unico del jugador
    if datos:
        return datos['puuid']
    else:
        return None

def obtener_perfil_basico(puuid):
    """
    Usa el PUUID para obtener el nivel y el ID del icono del jugador.
    """
    #Construye la URL usando la plantilla de la plataforma especifica
    url = f"{conf.URL_API_PLATAFORMA}/summoner/v4/summoners/by-puuid/{puuid}"
    
    #Realiza la peticion a la API de Riot
    datos = conf.conexion_riot(url)
    
    #Si la peticion fue exitosa, estructura y devuelve solo los datos necesarios
    if datos:
        return {
            "nivel": datos['summonerLevel'],
            "icono_id": datos['profileIconId']
        }
    else:
        return None

# --- Zona de Pruebas ---
if __name__ == "__main__":
    print("=== Buscador de LoL ===")
    print("Escribe 'salir' cuando quieras terminar el programa.")
    
    #Bucle principal para mantener el programa corriendo
    while True:
        print("-" * 30)
        nombre_usuario = input("Ingresa el Nombre del jugador o 'salir': ")
        
        #Condicion de salida del programa
        if nombre_usuario.lower() == "salir":
            print("¡Cerrando el buscador!")
            break
            
        etiqueta_usuario = input("Ingresa la Etiqueta (sin el #, ejemplo: LAN, KR1): ")
        
        print(f"\nBuscando a {nombre_usuario}#{etiqueta_usuario}...")

        #Obtener el PUUID (identificador unico de Riot)       
        mi_puuid = obtener_puuid(nombre_usuario, etiqueta_usuario)
        
        if mi_puuid:
            print(f"¡Jugador encontrado! PUUID: {mi_puuid}")
            
            #Usar el PUUID para traer el nivel y el icono desde el servidor local
            perfil = obtener_perfil_basico(mi_puuid)
            
            if perfil:
                print(f"Nivel: {perfil['nivel']}")
                print(f"ID del Icono: {perfil['icono_id']}")
        else:
            print("No se pudo encontrar al jugador. Revisa el nombre y etiqueta.")