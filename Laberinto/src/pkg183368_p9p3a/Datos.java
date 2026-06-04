/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pkg183368_p9p3a;

import java.util.ArrayList;

/**
 *
 * @author bobto
 */
public class Datos {
    private ArrayList<Jugador> jugadores;

    public Datos() {
        jugadores = new ArrayList<>();
    }

    public ArrayList<Jugador> getJugadores() {
        return jugadores;
    }
    
    public void addPlayers(Jugador player_1){
        jugadores.add(player_1);
    }
    
    
    public int busqueda(String user,String password){
        for(Jugador i: this.jugadores ){
            if(i.getUser().equals(user)){
                if(i.getPassword().equals(password)){
                    return this.jugadores.indexOf(i); // regresa la posicion del objeto en el que estamos
                }else{
                    return -1; // en caso de que la contraseña sea invalida
                }
            }
        }
        return -2;
    }
}
