/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package restaurante;

import javax.swing.SwingUtilities;

/**
 *
 * @author alfre
 */
public class Restaurante {

    public static void main(String[] args) {
       SwingUtilities.invokeLater(() -> new VentanaUsuario().setVisible(true));
    }
    
}
