/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pkg183368_p9p3a;

/**
 *
 * @author 183368
 */

import javax.swing.*;
import java.awt.*;

public class Mapa extends JPanel {
    private final char[][] mapa;
    private final int cellSize;

    public Mapa(char[][] mapa, int cellSize) {
        this.mapa = mapa;
        this.cellSize = cellSize;
        setPreferredSize(new Dimension(mapa[0].length * cellSize, mapa.length * cellSize));
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        for (int fila = 0; fila < mapa.length; fila++) {
            for (int col = 0; col < mapa[fila].length; col++) {
                char celda = mapa[fila][col];

                switch (celda) {
                    case '█': // Muro
                        g.setColor(Color.DARK_GRAY);
                        break;
                    case 'S': // Inicio
                        g.setColor(Color.GREEN);
                        break;
                    case 'E': // Meta
                        g.setColor(Color.RED);
                        break;
                    case 'R': // Reto
                        g.setColor(Color.ORANGE);
                        break;
                    default: // Camino libre
                        g.setColor(Color.LIGHT_GRAY);
                        break;
                }

                g.fillRect(col * cellSize, fila * cellSize, cellSize, cellSize);
                g.setColor(Color.BLACK);
                g.drawRect(col * cellSize, fila * cellSize, cellSize, cellSize);
            }
        }
    }
}