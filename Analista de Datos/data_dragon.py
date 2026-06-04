import requests

def obtener_version_actual():
    """
    Se conecta a Riot y pregunta cual es el ultimo parche del juego
    """
    url = "https://ddragon.leagueoflegends.com/api/versions.json"
    respuesta = requests.get(url)
    
    if respuesta.status_code == 200:
        versiones = respuesta.json()
        #La lista viene ordenada de la mas nueva a la mas vieja, 
        #asi que la posicion [0] es el parche actual.
        return versiones[1] #El 1 es el parche anterior (100% estable), por lo que no nos dara errores de icono o algo parecido
    else:
        return "14.6.1" #Ponemos una version de respaldo por si falla el internet

def obtener_url_icono_perfil(icono_id, version):
    """
    Arma el link directo a la imagen del icono de perfil del jugador.
    """
    url_imagen = f"https://ddragon.leagueoflegends.com/cdn/{version}/img/profileicon/{icono_id}.png"
    return url_imagen

def obtener_diccionario_campeones(version):
    """
    Descarga el libro de traducciones que tiene los nombres de todos los campeones.
    """
    #Usamos es_MX para que los nombres y datos salgan en español latino
    url = f"https://ddragon.leagueoflegends.com/cdn/{version}/data/es_MX/champion.json"
    respuesta = requests.get(url)
    
    if respuesta.status_code == 200:
        #Extraemos solo la parte que se llama 'data', que es donde estan los campeones
        return respuesta.json()['data']
    else:
        print("Error al descargar los datos de los campeones.")
        return None

def traducir_id_a_campeon(campeon_id, diccionario_campeones):
    """
    Busca un ID en el diccionario y devuelve el nombre real y el codigo de imagen.
    """
    #convertimos el texto a una cadena de texto para que el archivo data_dragon pueda buscar el icono, porque el lo usa como string.
    id_texto = str(campeon_id)
    
    #.items() nos permite revisar el diccionario campeon por campeon
    for nombre_interno, datos in diccionario_campeones.items():
        if datos['key'] == id_texto:
            nombre_real = datos['name']
            codigo_imagen = datos['id']
            return nombre_real, codigo_imagen
            
    return "Desconocido", "Desconocido"

def obtener_url_imagen_campeon(codigo_imagen, version):
    """
    Arma el link directo al icono del campeon.
    """
    url_imagen = f"https://ddragon.leagueoflegends.com/cdn/{version}/img/champion/{codigo_imagen}.png"
    return url_imagen

# --- Zona de Pruebas ---
if __name__ == "__main__":
    print("1. Buscando el parche actual de LoL...")
    parche_actual = obtener_version_actual()
    print(f"   ¡Estamos en el parche {parche_actual}!")
    
    print("\n2. Armando link para el icono de perfil #302...")
    link_icono = obtener_url_icono_perfil(302, parche_actual)
    print(f"   Link: {link_icono}")
    
    print("\n3. Descargando datos de campeones...")
    datos_completos = obtener_diccionario_campeones(parche_actual)
    
    if datos_completos:
        # Simulamos que la maestría nos dio el ID 157
        id_prueba = 157
        print(f"\n4. Buscando quién es el campeón con el ID {id_prueba}...")
        
        nombre, codigo_img = traducir_id_a_campeon(id_prueba, datos_completos)
        print(f"   Nombre real: {nombre}")
        print(f"   Código de imagen: {codigo_img}")
        
        link_campeon = obtener_url_imagen_campeon(codigo_img, parche_actual)
        print(f"   Link de su imagen: {link_campeon}")