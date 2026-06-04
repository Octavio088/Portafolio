/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pkg183368_p9p3a;

/**
 *
 * @author bobto
 */
public class Jugador {
    private String Nombre_completo;
    private int edad;
    private String sexo;
    private String user;
    private String password;

    public Jugador(String Nombre_completo, int edad, String sexo, String user, String password) {
        this.Nombre_completo = Nombre_completo;
        this.edad = edad;
        this.sexo = sexo;
        this.user = user;
        this.password = password;
    }
    public String getNombre_completo() {
        return Nombre_completo;
    }

    public int getEdad() {
        return edad;
    }

    public String getSexo() {
        return sexo;
    }

    public String getUser() {
        return user;
    }

    public String getPassword() {
        return password;
    }
    
}
