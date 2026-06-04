/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pkg183368_p9p3a;

import java.awt.Image;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JLayeredPane;
import javax.swing.JOptionPane;

/**
 *
 * @author bobto
 */
public class Juego extends JFrame {
    private JLabel personaje;  // Esta es la imagen del personaje
    private int x = 0, y = 0;  // Aquí está la posición del personaje en la pantalla (en píxeles)
    private final int cellSize = 30; // Tamaño de cada cuadrito del mapa

    // Este es el mapa del juego, con caminos, retos y paredes
    private final char[][] mapa = {
    {'S',' ','█',' ',' ',' ',' ',' ','█','R',' ',' ','R',' ','█'},
    {'█',' ','█',' ','█',' ','█',' ','█',' ','█',' ','█',' ','█'},
    {'█','R','█',' ','█','R','█',' ',' ','R','█',' ','█',' ','█'},
    {'█',' ',' ',' ','█',' ',' ',' ','█',' ',' ',' ','█',' ','█'},
    {'█','█','█',' ','█','█','█',' ','█','█','█',' ','█','█','█'},
    {'█',' ','R',' ',' ',' ','█',' ',' ',' ','█',' ','R',' ','█'},
    {'█',' ','█','█','█',' ','█','█','█',' ','█','█','█',' ','█'},
    {'█',' ','█',' ','█','R',' ',' ','█',' ','█','R','█','R','█'},
    {'█',' ','█',' ','█','█','█',' ','█','█','█',' ','█',' ','█'},
    {'█',' ',' ',' ','█',' ',' ',' ',' ',' ','█',' ',' ',' ','█'},
    {'█','█','█',' ','█',' ','█','█','█',' ','█','█','█',' ','█'},
    {'█','R',' ','R',' ',' ',' ',' ','R',' ',' ',' ',' ',' ','█'},
    {'█',' ','█','█','█','█','█','█','█','█','█','█','█','█','█'},
    {'█',' ',' ',' ',' ','R',' ','R',' ','R',' ',' ',' ',' ','E'},
    {'█','█','█','█','█','█','█','█','█','█','█','█','█','█','█'},
};

    // Este es el constructor, es decir, lo que se ejecuta cuando abrimos la ventana
    public Juego(String rutaImagen) {
        setTitle("Mueve a tu personaje"); // Título de la ventana
        setSize(600, 600); // Tamaño de la ventana
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); // Cuando cierres la ventana, termina el programa
        setLocationRelativeTo(null); // Pone la ventana en el centro de la pantalla
        setLayout(null); // No usaremos un diseño automático, colocaremos todo nosotros

        // Creamos y colocamos el mapa de cuadritos
        Mapa panelMapa = new Mapa(mapa, cellSize);
        panelMapa.setBounds(0, 0, cellSize * mapa[0].length, cellSize * mapa.length);
        getLayeredPane().add(panelMapa, JLayeredPane.DEFAULT_LAYER); // Lo ponemos al fondo

        // Creamos el personaje con la imagen que tú decidas
        ImageIcon icono = new ImageIcon(rutaImagen);
        personaje = new JLabel(new ImageIcon(icono.getImage().getScaledInstance(cellSize, cellSize, Image.SCALE_SMOOTH)));
        personaje.setBounds(x, y, cellSize, cellSize); // Lo colocamos en su lugar
        getLayeredPane().add(personaje, JLayeredPane.PALETTE_LAYER); // Lo ponemos encima del mapa

        // Ahora escuchamos cuando el niño o niña presiona las flechas del teclado
        addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent e) {
                int nuevaX = x;
                int nuevaY = y;

                // Dependiendo de la flecha que se presiona, cambiamos la posición
                if (e.getKeyCode() == KeyEvent.VK_UP) nuevaY -= cellSize;    // Arriba
                if (e.getKeyCode() == KeyEvent.VK_DOWN) nuevaY += cellSize;  // Abajo
                if (e.getKeyCode() == KeyEvent.VK_LEFT) nuevaX -= cellSize;  // Izquierda
                if (e.getKeyCode() == KeyEvent.VK_RIGHT) nuevaX += cellSize; // Derecha

                // Calculamos en qué fila y columna está ahora el personaje
                int fila = nuevaY / cellSize;
                int col = nuevaX / cellSize;

                // Si el personaje puede moverse ahí, lo movemos
                if (puedeMover(fila, col)) {
                    x = nuevaX;
                    y = nuevaY;
                    personaje.setLocation(x, y);

                    char celda = mapa[fila][col];
                    if (celda == 'R') {
                        // Si pisa una casilla con R, es un reto
                        JOptionPane.showMessageDialog(null, "¡Has encontrado un reto!");
                    } else if (celda == 'E') {
                        // Si pisa una casilla con E, es la meta
                        JOptionPane.showMessageDialog(null, "¡Llegaste a la meta!");
                    }
                }
            }
        });

        // Esto permite que la ventana escuche el teclado
        setFocusable(true);
        requestFocusInWindow();
        setVisible(true); // Mostramos la ventana
    }

    // Esta función revisa si el personaje se puede mover a una casilla
    private boolean puedeMover(int fila, int col) {
        return fila >= 0 && col >= 0 && 
               fila < mapa.length && col < mapa[0].length &&
               mapa[fila][col] != '█'; // No puede moverse a muros
    }
}
