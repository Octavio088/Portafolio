//Proyecto PROGRA I.- Jesús Alejandro Antonio Rocha && Octavio Vázquez Solorio
// Bibliotecas base de C
#include <stdio.h>
#include <conio.h>
#include <stdlib.h>
#include <time.h>
#include <windows.h>
#include <ctype.h>
#include <string.h>
#include <mmsystem.h>
// Constantes que emplearemos para la direccion de la tecla
#define RIGHT 77//M
#define LEFT 75//K
#define DOWN 80 //P
#define UP 72//H
#define ENTER 13 //Enter
#define ESC 27 //Salir Inmediato
#define SPACE 2//ESPACIO ENTRE CUADROS

//Estructura base donde guardaremos en el juego el usuario y su puntaje
typedef struct
{
	char userName[20];
	int puntos;
}player;
// Librerias creadas a partir de archivos .h
#include "score.h" // Nos sirve para guardar el score del jugador en un archivo del mismo nombre además de ordenarlos con el metodo burbuja
#include "funciones.h" // Aqui tenemos el Go to XY y ya
#include "pixelart.h" // Todos nuestros apoyos visuales de pixel arts
#include "menu_Fs.h" // Contiene lasfunciones presenta menu (que es el visual de nuestro menu y scroll menu que permite scrolearlo con las flechas)
#include "Ayuda.h" // Simplemente contiene la funcion de moestar el archivo de ayuda
#include "juego.h" //Contiene todo nuestro juego siendo nuestra libreria principal
int main(){
DWORD volume = 0x80008000;
waveOutSetVolume(NULL, volume);
int op=0;  //opcion para el menú
int x=10,y=10; //Posiciones iniciales en x y y
///////////////////////////////
char nomArch[20]="score.txt";   //Asignamos el nombre del arcivo de el score para las puntuaciones
player users[6]; //arreglo de estructuras para los jugadores
/////////////////////////////////
system("MODE 79,45"); //Ajusta la pantalla
srand(time(0)); //Para reiniciar los randoms y que no siempre salgan los mismos

mainPortada(gg,45,79,0,0);//Mandamos llamar al pixelart de la portada
/////////////////////////////////////////////////////////////////////////////// bloque de texto con datos de los alumnos
sndPlaySound("pitbull.wav", SND_ASYNC | SND_FILENAME | SND_LOOP);
gotoxy(14,0.5);
SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),240);
printf("UNIVERSIDAD POLITECNICA DE SAN LUIS POTOSI\n");
gotoxy(21,1);
printf("DOCENTE: DRA. ROXANA HERRERA\n");
gotoxy(21,2);
printf("MATERIA:PROGRAMACION I\n");
gotoxy(1,3);
printf("ALUMNOS: JESUS ALEJANDRO ANTONIO ROCHA && OCTAVIO VAZQUEZ SOLORIO\n");
gotoxy(18,4);
printf("MATRICULAS: 183368 && 183955\n");

//gotoxy(9,36);
//printf("PRESIONA CUALQUIER TECLA PARA CONTINUAR");
texto(9,36); //funcion para imprimir el texto dinamico 
getch();
sndPlaySound(NULL, SND_ASYNC | SND_FILENAME | SND_ASYNC);
do{
	SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),0); //regresamos a negro el color de la interfaz
	
	presenta_menu(x,y); //mandamos llamar la funcion presenta menu y le damos los parametros que teniamos de x y y que serán la posicion en la cual empezara a desplegarse nuestro menu
	op=scroll_menu(x,y,4);// mandamos llamar la funcion menu, le pasamos el parametro de su posicion en x y y asi como el numero de opciones, la opcion que regrese será asignada a la variable op
	system("cls"); //limpia pantalla
	
	switch(op) //switch que aplica casos segun el numero de opcion
	{
		case 1:	sndPlaySound(NULL, SND_ASYNC | SND_FILENAME | SND_ASYNC);
		        system("MODE 96,51");
				mainJuego(); break; // trae la funcion main juego en la cual contiene en su interior las funciones muestra menu y scroll menu 
	 	case 2:	
		       readPlayers(nomArch,users); // lee los jugadores que se encuentran en el archivo y los ordena de menor a mayor
			   printPlayers(users); //imprime los usuarios del archivo
			   getch();
			   break;
		case 3:
		       ayuda();break; // muestra el archivo de ayuda a tarvés de la funcion ayuda
	 	case 4:screen(GameOver,45,88,0,0);
		 break; // Solo imprime salir
	}
 }while(op!=4);
 return 0;
}
