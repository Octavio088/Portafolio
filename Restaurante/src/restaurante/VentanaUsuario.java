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
import java.util.HashMap;
import static javax.swing.WindowConstants.EXIT_ON_CLOSE;

public class VentanaUsuario extends JFrame {
    private CardLayout cardLayout;
    private JPanel panelPrincipal;
    private HashMap<String, String> usuarios = new HashMap<>();

    private final Color azulClaro = new Color(52, 152, 219);
    private final Color fondo = new Color(245, 245, 245);
    private final Font fuentePrincipal = new Font("Segoe UI", Font.PLAIN, 16);
    private final Font fuenteTitulo = new Font("Segoe UI", Font.BOLD, 24);

    public VentanaUsuario() {
        setTitle("Sistema de Usuario");
        setSize(420, 520);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setResizable(false);

        cardLayout = new CardLayout();
        panelPrincipal = new JPanel(cardLayout);

        panelPrincipal.add(crearPanelInicio(), "inicio");
        panelPrincipal.add(crearPanelRegistro(), "registro");
        panelPrincipal.add(crearPanelLogin(), "login");

        add(panelPrincipal);
        cardLayout.show(panelPrincipal, "inicio");
    }

    private JPanel crearPanelInicio() {
        JPanel panel = new JPanel(new BorderLayout());
        panel.setBackground(fondo);

        JLabel titulo = new JLabel("Bienvenido", SwingConstants.CENTER);
        titulo.setFont(fuenteTitulo);
        titulo.setForeground(azulClaro);

        JButton btnLogin = crearBoton("Iniciar Sesión");
        JButton btnRegistro = crearBoton("Crear Usuario");

        JPanel botones = new JPanel();
        botones.setBackground(fondo);
        botones.add(btnLogin);
        botones.add(btnRegistro);

        panel.add(titulo, BorderLayout.CENTER);
        panel.add(botones, BorderLayout.SOUTH);

        btnLogin.addActionListener(e -> cardLayout.show(panelPrincipal, "login"));
        btnRegistro.addActionListener(e -> cardLayout.show(panelPrincipal, "registro"));

        return panel;
    }

    private JPanel crearPanelRegistro() {
        JPanel panel = crearPanelFormulario();

        JTextField campoUsuario = crearCampoTexto();
        JPasswordField campoPassword = new JPasswordField();
        campoPassword.setFont(fuentePrincipal);

        JButton btnRegistrar = crearBoton("Registrar");
        JButton btnVolver = crearBoton("Volver");

        panel.add(new JLabel("Nombre de usuario:", SwingConstants.LEFT));
        panel.add(campoUsuario);
        panel.add(new JLabel("Contraseña:", SwingConstants.LEFT));
        panel.add(campoPassword);
        panel.add(btnRegistrar);
        panel.add(btnVolver);

        btnRegistrar.addActionListener(e -> {
            String usuario = campoUsuario.getText();
            String contraseña = new String(campoPassword.getPassword());

            if (usuario.isEmpty() || contraseña.isEmpty()) {
                mostrarError("Completa todos los campos");
            } else if (usuarios.containsKey(usuario)) {
                mostrarError("El usuario ya existe");
            } else {
                usuarios.put(usuario, contraseña);
                JOptionPane.showMessageDialog(this, "Usuario creado exitosamente");
                cardLayout.show(panelPrincipal, "login");
            }
        });

        btnVolver.addActionListener(e -> cardLayout.show(panelPrincipal, "inicio"));
        return panel;
    }

    private JPanel crearPanelLogin() {
        JPanel panel = crearPanelFormulario();

        JTextField campoUsuario = crearCampoTexto();
        JPasswordField campoPassword = new JPasswordField();
        campoPassword.setFont(fuentePrincipal);

        JButton btnEntrar = crearBoton("Entrar");
        JButton btnVolver = crearBoton("Volver");

        panel.add(new JLabel("Nombre de usuario:", SwingConstants.LEFT));
        panel.add(campoUsuario);
        panel.add(new JLabel("Contraseña:", SwingConstants.LEFT));
        panel.add(campoPassword);
        panel.add(btnEntrar);
        panel.add(btnVolver);

        btnEntrar.addActionListener(e -> {
            String usuario = campoUsuario.getText();
            String contraseña = new String(campoPassword.getPassword());

            if (usuarios.containsKey(usuario) && usuarios.get(usuario).equals(contraseña)) {
                JOptionPane.showMessageDialog(this, "Bienvenido " + usuario);
                // Lanza el sistema POS abriendo la ventana Mesas (6 mesas)
                SwingUtilities.invokeLater(() -> {
                    new Mesas().setVisible(true);
                });
                dispose(); // Cierra la ventana de login
            } else {
                mostrarError("Usuario o contraseña incorrectos");
            }
        });

        btnVolver.addActionListener(e -> cardLayout.show(panelPrincipal, "inicio"));
        return panel;
    }

    // Métodos auxiliares

    private JPanel crearPanelFormulario() {
        JPanel panel = new JPanel(new GridLayout(6, 1, 10, 10));
        panel.setBackground(fondo);
        panel.setBorder(BorderFactory.createEmptyBorder(40, 40, 40, 40));
        return panel;
    }

    private JTextField crearCampoTexto() {
        JTextField campo = new JTextField();
        campo.setFont(fuentePrincipal);
        return campo;
    }

    private JButton crearBoton(String texto) {
        JButton btn = new JButton(texto);
        btn.setBackground(azulClaro);
        btn.setForeground(Color.WHITE);
        btn.setFont(fuentePrincipal);
        btn.setFocusPainted(false);
        btn.setCursor(new Cursor(Cursor.HAND_CURSOR));
        return btn;
    }

    private void mostrarError(String mensaje) {
        JOptionPane.showMessageDialog(this, mensaje, "Error", JOptionPane.ERROR_MESSAGE);
    }
}
