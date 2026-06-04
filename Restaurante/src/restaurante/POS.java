/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restaurante;

/**
 *
 * @author alfre
 * 
 * 
 * 
 */
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.net.URL;
import java.util.*;

public class POS extends JFrame {

    private DefaultListModel<String> ticketModel;
    private JList<String> ticketList;
    private JButton btnAgregarProducto, btnEliminarProducto, btnPagar, btnVolverMesas;
    private JLabel totalLabel;
    private Map<String, Double> precios = new LinkedHashMap<>();
    private double total = 0;
    private String nombreCliente;
    private String numeroMesa;
    private Mesas ventanaMesas;
    private int indiceMesa;

    public POS(String cliente, String mesa, Mesas ventanaMesas, int indiceMesa) {
        this.nombreCliente = cliente;
        this.numeroMesa = mesa;
        this.ventanaMesas = ventanaMesas;
        this.indiceMesa = indiceMesa;

        setTitle("POS - " + numeroMesa);
        setSize(900, 600);
        setDefaultCloseOperation(DISPOSE_ON_CLOSE);
        setLocationRelativeTo(null);
        setLayout(new BorderLayout());

        inicializarPrecios();

        JLabel infoLabel = new JLabel("Cliente: " + nombreCliente + " | " + numeroMesa);
        infoLabel.setFont(new Font("Segoe UI", Font.BOLD, 16));
        infoLabel.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
        add(infoLabel, BorderLayout.NORTH);

        ticketModel = new DefaultListModel<>();
        ticketList = new JList<>(ticketModel);
        JScrollPane scrollTicket = new JScrollPane(ticketList);
        scrollTicket.setBorder(BorderFactory.createTitledBorder("Ticket"));
        scrollTicket.setPreferredSize(new Dimension(250, 0));
        add(scrollTicket, BorderLayout.WEST);

        JPanel panelDerecho = new JPanel(new GridLayout(6, 1, 10, 10));
        panelDerecho.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));

        btnAgregarProducto = new JButton("Agregar producto");
        btnEliminarProducto = new JButton("Eliminar producto");
        btnPagar = new JButton("Pagar");
        btnVolverMesas = new JButton("Volver a Mesas");
        totalLabel = new JLabel("Total: $0.00");
        totalLabel.setFont(new Font("Segoe UI", Font.BOLD, 18));
        totalLabel.setHorizontalAlignment(SwingConstants.CENTER);

        panelDerecho.add(btnAgregarProducto);
        panelDerecho.add(btnEliminarProducto);
        panelDerecho.add(btnPagar);
        panelDerecho.add(btnVolverMesas);
        panelDerecho.add(new JLabel(""));
        panelDerecho.add(totalLabel);

        panelDerecho.setPreferredSize(new Dimension(200, 0));
        add(panelDerecho, BorderLayout.EAST);

        JPanel menuPanel = new JPanel(new GridLayout(3, 1));
        menuPanel.add(crearSeccion("Alimentos", new String[]{"Pizza", "Hamburguesa", "Papas fritas"}));
        menuPanel.add(crearSeccion("Bebidas", new String[]{"Agua", "Refresco"}));
        menuPanel.add(crearSeccion("Postres", new String[]{"Pastel", "Helado", "Flan"}));
        add(menuPanel, BorderLayout.CENTER);

        btnAgregarProducto.addActionListener(e -> agregarProducto());
        btnEliminarProducto.addActionListener(e -> eliminarProducto());
        btnPagar.addActionListener(e -> pagar());
        btnVolverMesas.addActionListener(e -> this.setVisible(false));
    }

    private void inicializarPrecios() {
        precios.put("Pizza", 120.0);
        precios.put("Hamburguesa", 80.0);
        precios.put("Papas fritas", 40.0);
        precios.put("Agua", 15.0);
        precios.put("Refresco", 25.0);
        precios.put("Pastel", 35.0);
        precios.put("Helado", 25.0);
        precios.put("Flan", 20.0);
    }

    private JPanel crearSeccion(String titulo, String[] items) {
        JPanel panel = new JPanel(new GridLayout(1, items.length));
        panel.setBorder(BorderFactory.createTitledBorder(titulo));
        for (String item : items) {
            JButton btn = crearBotonConImagen(item);
            panel.add(btn);
        }
        return panel;
    }

    private JButton crearBotonConImagen(String item) {
        String precio = String.format("$%.2f", precios.get(item));
        String texto = "<html><center>" + item + "<br>" + precio + "</center></html>";

        String nombreArchivo = item.toLowerCase().replace(" ", "") + ".jpg";
        URL url = getClass().getClassLoader().getResource("images/" + nombreArchivo);

        ImageIcon icono;
        if (url != null) {
            icono = new ImageIcon(new ImageIcon(url).getImage().getScaledInstance(100, 70, Image.SCALE_SMOOTH));
        } else {
            System.err.println("Imagen no encontrada: " + nombreArchivo);
            icono = new ImageIcon();
        }

        JButton boton = new JButton(texto, icono);
        boton.setVerticalTextPosition(SwingConstants.BOTTOM);
        boton.setHorizontalTextPosition(SwingConstants.CENTER);
        boton.setFocusPainted(false);
        boton.addActionListener(e -> agregarAlTicket(item));
        return boton;
    }

    private void agregarAlTicket(String item) {
        ticketModel.addElement(item + " - $" + precios.get(item));
        recalcularTotal();
    }

    private void agregarProducto() {
        String[] productos = precios.keySet().toArray(new String[0]);
        String producto = (String) JOptionPane.showInputDialog(this,
                "Selecciona un producto", "Agregar producto",
                JOptionPane.PLAIN_MESSAGE, null, productos, productos[0]);

        if (producto != null) {
            String cantidadStr = JOptionPane.showInputDialog(this, "Cantidad:");
            try {
                int cantidad = Integer.parseInt(cantidadStr);
                if (cantidad <= 0) throw new NumberFormatException();

                for (int i = 0; i < cantidad; i++) {
                    ticketModel.addElement(producto + " - $" + precios.get(producto));
                }
                recalcularTotal();
            } catch (NumberFormatException ex) {
                JOptionPane.showMessageDialog(this, "Cantidad inválida", "Error", JOptionPane.ERROR_MESSAGE);
            }
        }
    }

    private void eliminarProducto() {
        int seleccionado = ticketList.getSelectedIndex();
        if (seleccionado != -1) {
            ticketModel.remove(seleccionado);
            recalcularTotal();
        } else {
            JOptionPane.showMessageDialog(this, "Selecciona un producto para eliminar");
        }
    }

    private void recalcularTotal() {
        total = 0;
        for (int i = 0; i < ticketModel.size(); i++) {
            String elemento = ticketModel.get(i);
            int signoPesos = elemento.indexOf("$");
            if (signoPesos != -1) {
                String precioStr = elemento.substring(signoPesos + 1).trim();
                try {
                    total += Double.parseDouble(precioStr);
                } catch (NumberFormatException e) {
                    // ignorar errores de parseo
                }
            }
        }
        totalLabel.setText(String.format("Total: $%.2f", total));
    }

    private void pagar() {
        if (ticketModel.isEmpty()) {
            JOptionPane.showMessageDialog(this, "No hay productos en el ticket");
            return;
        }

        String dineroRecibidoStr = JOptionPane.showInputDialog(this,
                "Total a pagar: $" + String.format("%.2f", total) + "\nIngrese dinero recibido:");

        try {
            double dineroRecibido = Double.parseDouble(dineroRecibidoStr);
            if (dineroRecibido < total) {
                JOptionPane.showMessageDialog(this, "Dinero insuficiente", "Error", JOptionPane.ERROR_MESSAGE);
                return;
            }
            double cambio = dineroRecibido - total;
            JOptionPane.showMessageDialog(this, "Cambio: $" + String.format("%.2f", cambio));

            ventanaMesas.actualizarEstadoMesa(indiceMesa, false);
            this.dispose();

        } catch (NumberFormatException e) {
            JOptionPane.showMessageDialog(this, "Cantidad inválida", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }
}

