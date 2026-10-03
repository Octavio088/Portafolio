document.getElementById('post-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Obtener valores del formulario
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const user = document.getElementById('User').value;


    // Crear un nuevo elemento de publicación
    const post = document.createElement('div');
    post.classList.add('post');

    // Agregar título y contenido a la publicación
    const postTitle = document.createElement('h2');
    postTitle.textContent = title;
    const postContent = document.createElement('h3');
    postContent.textContent = content;
    const postUser = document.createElement('p');
    postUser.textContent = user;
    const hrElement = document.createElement('hr');
    hrElement.classList.add('my-4');

    post.appendChild(postTitle);
    post.appendChild(postContent);
    post.appendChild(postUser);
    post.appendChild(hrElement);
    // Agregar la nueva publicación al blog
    document.getElementById('blog-posts').appendChild(post);

    // Limpiar el formulario
    document.getElementById('post-form').reset();
});


function redirigir(url) {
    window.location.href = url ; 
}


function PDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const nombres = [
"Listado De Docentes de la Academia:",        
"	Aguilar Rodríguez Araceli Gabriela	",
"	Alonso Álvarez María Alicia	",
"	Alonso Ruiz Ma. De Jesús	",
"	Arriaga Santos Carlos Adrián	",
"	Banda  Guzmán Víctor Miguel	",
"	Bautista Bautista Italo Carlos Delfino	",
"	Cabrera Salinas Dinorah 	",
"	Cerda Lugo Angel de Jesus	",
"	Chávez Pérez Manuel 	",
"	De León Lomelí Luz Roxana	",
"	Díaz Díaz Irwin Allen	",
"	Flores Gutiérrez Claudia Patricia	",
"	García Haro Guillermo 	",
"	González Salas Javier Salvador	",
"	González Torres Jorge Isaac	",
"	Grimaldo Martínez Ana Isabel	",
"	Guerrero Castillo Israel 	",
"	Hernández  Delgado Zaira Elizabeth	",
"	Hernández Escobar Erika Nohemí	",
"	Hernández Martínez Imelda Deyanira	",
"	Herrera Herrera Roxana Georgina	",
"	Islas González María De Guadalupe	",
"	Jerónimo Moreno Yasser 	",
"	Ledesma Ramos Guadalupe 	",
"	Leija Martínez Nehemías 	",
"	López Quirino David Uriel	",
"	Martínez Galla Baltazar 	",
"	Martínez Martínez Leopoldo José Alfredo	",
"	Martínez Mendoza Víctor Gabriel	",
"	Méndez Leal Jorge Martín	",
"	Moncada González Héctor Raúl	",
"	Montañez Medina Adolfo Antonio	",
"	Morales Robles Fermín 	",
"	Niño Carrales Genaro 	",
"	Pérez Castillo Paulina Del Rosario	",
"	Ramírez González María Guadalupe	",
"	Ramírez López Marisol 	",
"	Reyes  Alejandro 	",
"	Reyes Velázquez Eduardo Alberto	",
"	Reyna López Catalina 	",
"	Robles Centeno Laura Virginia	",
"	Ruiz Cigarrillo Oscar  	",
"	Sánchez  Vásquez José Daniel 	",
"	Sandoval Ortiz Andrés 	",
"	Silva Rodríguez Genoveva Viridiana	",
"	Tolentino Jiménez José Ramón	",
"	Trejo Martínez Francisco Eduardo	",
"	Vargas Olmos Cecilia 	",
"	Velázquez Durán Miguel De Jesús	",
"	Zúñiga Hernández Erika Adriana 	"
    ];

    const pageHeight = doc.internal.pageSize.height;
    let y = 20;
    const lineHeight = 10;
    const margin = 20;

    doc.setFontSize(12);

    nombres.forEach((nombre, index) => {
        // Si la posición y + lineHeight es mayor que la altura de la página menos el margen, añadir una nueva página
        if (y + lineHeight > pageHeight - margin) {
            doc.addPage();
            y = margin;
        }
        doc.text(nombre, margin, y);
        y += lineHeight;
    });

    // Generar el PDF como un Blob
    const pdfBlob = doc.output('blob');

    // Crear un objeto URL para el Blob y abrirlo en una nueva ventana
    const pdfUrl = URL.createObjectURL(pdfBlob);
    window.open(pdfUrl);
}
function PDF_2() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const nombres = [
"	Microsoft Office Specialist (Word, Excel, PowerPoint, Access, Excel Experto) 	",
"	Key English Test (KET) de Cambridge University 	",
"	Preliminary English Test (PET) de Cambridge University 	",
"	Fisrt Certificate in English (FCE) de Cambridge University 	",
"	Adobe (Photoshop, Flash, Dreamweaver) 	",
"	Certificación CCNA 	",
"	Certificación CCENT 1 	",
"	Certificación CCENT 2 	",
"	Certificación A+ 	",
"	Certificación COMPTIA Strata 	",
"	Certificación LINUX ESSENTIALS 	",
"	HP ATA CONNECTED DEVICES 	",
"	HP ATA NETWORKS 	",
"	MTA Windows® Operating System Fundamentals 	",
"	MTA Software Development Fundamentals (C#) 	",
"	MTA Software Development Fundamentals (VB) 	",
"	MTA Database Fundamentals 	",
"	MTA Windows® Server Administration Fundamentals 	",
"	MTA Networking Fundamentals 	",
"	MTA Security Fundamentals 	",
"	MTA Cloud Fundamentals 	",
"	MTA HTML5 Application Development Fundamentals 	",
"	MTA Introduction to Programming using JavaScript 	",
"	MTA Introduction to Programming using HTML and CSS 	",
"	MTA Introduction to Programming using Java 	",
"	Oracle Java Standard Edition 5 and 6 Certified (Programación Orientada a Objetos), 	",
"	Oracle Solaris 10 Certified (Sistemas Operativos),  	",
"	Oracle Certified MySQL Developer (Base de Datos) 	",
"	Unity User: Programmer 	",
"	Unity User: VR Developer 	",
"	ITS Cloud Computing	",
"	ITS Cybersecurity	",
"	ITS Databases	",
"	ITS HTML and CSS	",
"	ITS Java	",
"	ITS JavaScript	",
"	ITS Network Security	",
"	ITS Networking	",
"	ITS Python	",
"	CISCO CCST CYBERSECURITY	",
"	Fortinet NSE 1, 2, 3, 4, 5, 6	",
"	PMI Ready 	"

    ];

    const pageHeight = doc.internal.pageSize.height;
    let y = 20;
    const lineHeight = 10;
    const margin = 20;

    doc.setFontSize(12);

    nombres.forEach((nombre, index) => {
        // Si la posición y + lineHeight es mayor que la altura de la página menos el margen, añadir una nueva página
        if (y + lineHeight > pageHeight - margin) {
            doc.addPage();
            y = margin;
        }
        doc.text(nombre, margin, y);
        y += lineHeight;
    });

    // Generar el PDF como un Blob
    const pdfBlob = doc.output('blob');

    // Crear un objeto URL para el Blob y abrirlo en una nueva ventana
    const pdfUrl = URL.createObjectURL(pdfBlob);
    window.open(pdfUrl);
}