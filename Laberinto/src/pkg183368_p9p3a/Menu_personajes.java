/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pkg183368_p9p3a;

import java.awt.GridLayout;
import java.awt.Image;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.SwingConstants;

/**
 *
 * @author bobto
 */
public class Menu_personajes extends JFrame {
    public Menu_personajes() {
        setTitle("Selecciona tu personaje");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLayout(new GridLayout(2, 2, 10, 10));
        setSize(600, 400);
        setLocationRelativeTo(null);

        String[] nombres = {"Hoffman", "Harrington", "Ale", "Alcapone"};

        for (String nombre : nombres) {
            ImageIcon icono = new ImageIcon(nombre + ".jpg");
            JButton boton = new JButton(nombre, new ImageIcon(icono.getImage().getScaledInstance(100, 100, Image.SCALE_SMOOTH)));
            boton.setVerticalTextPosition(SwingConstants.BOTTOM);
            boton.setHorizontalTextPosition(SwingConstants.CENTER);

            boton.addActionListener(e -> {
                new Juego(nombre + ".jpg");
                dispose();
            });

            add(boton);
        }

        setVisible(true);
    }
}
