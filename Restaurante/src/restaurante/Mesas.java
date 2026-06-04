/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restaurante;

/**
 *
 * @author alfre
 */

import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.net.URL;

public class Mesas extends JFrame {
    private final int NUM_MESAS = 10;
    private JButton[] botonesMesas = new JButton[NUM_MESAS];
    private boolean[] mesasOcupadas = new boolean[NUM_MESAS];
    private POS[] ticketsMesas = new POS[NUM_MESAS];
    private Image fondo;

    public Mesas() {
        setTitle("Mesas del Restaurante");
        setSize(1000, 600);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // Cargar imagen de fondo
        URL fondoURL = getClass().getResource("/images/fondo.jfif");
        if (fondoURL != null) {
            fondo = new ImageIcon(fondoURL).getImage();
        } else {
            System.err.println("No se encontró fondo.jfif en /images/");
        }

        JPanel panelFondo = new JPanel() {
            @Override
            protected void paintComponent(Graphics g) {
                super.paintComponent(g);
                if (fondo != null) {
                    g.drawImage(fondo, 0, 0, getWidth(), getHeight(), this);
                }
            }
        };
        panelFondo.setLayout(null);
        setContentPane(panelFondo);

        int columnas = 5;
        int filas = 2;
        int ancho = 120;
        int alto = 80;
        int espaciadoX = 60;
        int espaciadoY = 50;

        int totalAnchoMesas = columnas * ancho + (columnas - 1) * espaciadoX;
        int totalAltoMesas = filas * alto + (filas - 1) * espaciadoY;

        int offsetX = (getWidth() - totalAnchoMesas) / 2;
        int offsetY = (getHeight() - totalAltoMesas) / 2 - 30; // arriba para dejar espacio al botón

        for (int i = 0; i < NUM_MESAS; i++) {
            int fila = i / columnas;
            int col = i % columnas;
            int x = offsetX + col * (ancho + espaciadoX);
            int y = offsetY + fila * (alto + espaciadoY);

            int indice = i;
            JButton boton = new JButton("Mesa " + (i + 1));
            boton.setBounds(x, y, ancho, alto);
            boton.setBackground(Color.GREEN);
            boton.setOpaque(true);
            boton.setBorderPainted(false);
            boton.setFont(new Font("Segoe UI", Font.BOLD, 16));
            boton.setForeground(Color.BLACK);

            boton.addActionListener(e -> {
                if (mesasOcupadas[indice]) {
                    if (ticketsMesas[indice] != null) {
                        ticketsMesas[indice].setVisible(true);
                        ticketsMesas[indice].toFront();
                        ticketsMesas[indice].requestFocus();
                    } else {
                        abrirPOS(indice);
                    }
                } else {
                    abrirPOS(indice);
                }
            });

            botonesMesas[i] = boton;
            mesasOcupadas[i] = false;
            panelFondo.add(boton);
        }

        // Botón cerrar sesión
        JButton btnCerrarSesion = new JButton("Cerrar sesión");
        btnCerrarSesion.setBounds(820, 500, 130, 30);
        btnCerrarSesion.setBackground(Color.ORANGE);
        btnCerrarSesion.setForeground(Color.BLACK);
        btnCerrarSesion.setFocusPainted(false);
        btnCerrarSesion.addActionListener(e -> {
            int confirm = JOptionPane.showConfirmDialog(this, "¿Deseas cerrar sesión?", "Confirmar", JOptionPane.YES_NO_OPTION);
            if (confirm == JOptionPane.YES_OPTION) {
                SwingUtilities.invokeLater(() -> new VentanaUsuario().setVisible(true));
                dispose();
            }
        });
        panelFondo.add(btnCerrarSesion);

        setVisible(true);
    }

    private void abrirPOS(int indiceMesa) {
        mesasOcupadas[indiceMesa] = true;
        actualizarEstadoMesa(indiceMesa, true);

        String cliente = JOptionPane.showInputDialog(this, "Nombre del cliente para la mesa " + (indiceMesa + 1) + ":");
        if (cliente == null || cliente.trim().isEmpty()) {
            mesasOcupadas[indiceMesa] = false;
            actualizarEstadoMesa(indiceMesa, false);
            return;
        }

        POS pos = new POS(cliente.trim(), "Mesa " + (indiceMesa + 1), this, indiceMesa);
        ticketsMesas[indiceMesa] = pos;
        pos.setVisible(true);
    }

    public void actualizarEstadoMesa(int indiceMesa, boolean ocupada) {
        mesasOcupadas[indiceMesa] = ocupada;
        if (ocupada) {
            botonesMesas[indiceMesa].setBackground(Color.RED);
            botonesMesas[indiceMesa].setForeground(Color.WHITE);
        } else {
            botonesMesas[indiceMesa].setBackground(Color.GREEN);
            botonesMesas[indiceMesa].setForeground(Color.BLACK);
            ticketsMesas[indiceMesa] = null;
        }
    }
}
