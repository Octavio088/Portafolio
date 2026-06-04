//Proyecto PROGRA I.- Jesús Alejandro Antonio Rocha && Octavio Vázquez Solorio

typedef struct{
	int i,j;
	int infoCarta;//Para saber que carta se mueve
	int x,y; //Saber la posicion de la carta
}abierta;// Estructuca de Carta abierta

int checkabiertas[10]={0};
int pares=0,movs=0; //Variables globales para contar numero de pares y de movimientos
/////////////// Declaracion de funciones
void mainJuego(); // funcion principal del juego
void cuadro(int posX,int posY,int ancho,int alto, int color); // Pinta un cuadro segun los valores indicados en sus parametros
void tablero(int posX,int posY,int ancho, int alto,int rens, int cols,int infoTabla[4][5]); // Pinta el tablero iniciando en las posiciones indicadas.
void ocultacartas(int posX,int posY,int ancho, int alto,int rens, int cols,int infoTabla[4][5]); //Permite Voltear las cartas para ocultarlas
void moverCuadro(int posX, int posY, int ancho, int alto, int ren, int col,int infoTabla[4][5]); // Nos permite navegar con el cuadro verdecito para seleccionar cartas
void asignaCartas(int infoTabla[4][5]); //Le asigna un numero aleatorio del 0 al 9 a cada carta
////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Funcion Principal del juego, permite 
void mainJuego()
{
	sndPlaySound("shakira.wav", SND_ASYNC | SND_FILENAME | SND_LOOP);
	int ren=4, col=5, ancho=10, alto=10; 
	int infoTabla[4][5]={0};
	cuadro(0.5,0.5,62,49,2);
	cuadro(64,0.5,30,15,2);		
	asignaCartas(infoTabla);
	tablero(2,2,ancho,alto,ren,col,infoTabla);
		SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),3);
	gotoxy(22,1);
	printf("MEMORAMA:");
	gotoxy(64,43);
	printf("PROGRAMACION I");
	gotoxy(64,44);
	printf("DRA ROXANA HERRERA");
	gotoxy(64,45);
	printf("ALUMNOS:");
	gotoxy(64,46);
	printf("JESUS ALEJANDRO ROCHA");
	gotoxy(64,47);
	printf("OCTAVIO VAZQUEZ SOLORIO\n");
	bb(balon,21,22,69,18);
	Sleep(1800);
	ocultacartas(2,2,ancho,alto,ren,col,infoTabla);	
	moverCuadro(2,2,ancho,alto,ren,col,infoTabla);

}

void cuadro(int posX,int posY,int ancho,int alto,int color)
{
	int i;
	SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),color);
	for(i=0;i<ancho;i++)//horizontales
	{
		gotoxy(posX+i,posY);
		printf("%c",205);//--- 196
		gotoxy(posX+i,posY+alto);
		printf("%c",205);//=	
	//	Sleep(100);
	}
	for(i=0;i<alto;i++)
	{
		gotoxy(posX,posY+i);
		printf("%c",186);//||
		gotoxy(posX+ancho,posY+i);
		printf("%c",186);//||		
	}

	gotoxy(posX,posY);printf("%c",201);
	gotoxy(posX+ancho,posY);printf("%c",187);
	gotoxy(posX,posY+alto);printf("%c",200);
	gotoxy(posX+ancho,posY+alto);printf("%c",188); //217
	
}

void tablero(int posX,int posY,int ancho, int alto,int rens, int cols,int infoTabla[4][5])
{
	int x, y, i,j, color=15;
	for(y=posY,i=0;i<rens;i++,y=y+alto+SPACE)//renglones
		for(x=posX,j=0;j<cols;j++,x=x+ancho+SPACE)//columnas
		{
			selecPixel(infoTabla[i][j],10,10,x,y);
			cuadro(x,y,ancho,alto,15);
			//gotoxy(x+(ancho/2),y+(alto/2)+1);
			//printf("%d",infoTabla[i][j]);

		}
}

void ocultacartas(int posX,int posY,int ancho, int alto,int rens, int cols,int infoTabla[4][5])
{
	int x, y, i,j, color=15;
	for(y=posY,i=0;i<rens;i++,y=y+alto+SPACE)//renglones
		for(x=posX,j=0;j<cols;j++,x=x+ancho+SPACE)//columnas
		{
			
			selecPixel(10,10,10,x,y);
			cuadro(x,y,ancho,alto,15);
			gotoxy(x+(ancho/2),y+(alto/2)+1);
			//printf("%d",infoTabla[i][j]);

		}
}
void moverCuadro(int posX, int posY, int ancho, int alto, int ren, int col, int infoTabla[4][5])
{
	int x=posX, y=posY;
	int i=0, j=0;
	char tecla=0;
	/////////////--Para Score--///////////////
	char userName[20];
	int puntos;
	char nomArch[20]="score.txt";
	player users[6]; //arreglo de estructuras para los jugadores
	/////////////////
	int checkTabla[4][5]={0};//
	int contOpen=0;//Contador de cartas abiertas
	abierta c[2]={{0,0,0},{0,0,0}};//Pares de cartas que se abren
	
	cuadro(x,y,ancho,alto,2);//Pinta cuadro inicial
	do{
		tecla=getch();
		cuadro(x,y,ancho,alto,15);
		switch(tecla){
			case RIGHT:
				if(j<(col-1)){
					j++;
					x=x+ancho+SPACE;
				}
				break;	
			case DOWN:
				if(i<(ren-1)){
					i++;
					y=y+alto+SPACE;
				}
				break;
			case LEFT:
				if(j>0){
					j--;
					x=x-ancho-SPACE;
				}
				break;
			case UP:
				if(i>0){
					i--;
					y=y-alto-SPACE;
				}
				break;
			case ENTER:
				if(contOpen<2)//Se destapan las cartas
				{
					if (checkTabla[i][j]==0) //&& checkabiertas[c[0].infoCarta]==0
					{
						cuadro(x,y,ancho,alto,14);
						Sleep(200);
						gotoxy(x+(ancho/2),y+(alto/2)+1);
						SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),15);
						printf("%d",infoTabla[i][j]);
						checkTabla[i][j]=1;
						//Guardar carta
						c[contOpen].i=i;	
						c[contOpen].j=j;	
						c[contOpen].x=x;	
						c[contOpen].y=y;
						c[contOpen].infoCarta=infoTabla[i][j];
						//////////////////////////////	
						gotoxy(71,5);
						printf("Carta 1: %d",c[contOpen].infoCarta);
						selecPixel(c[contOpen].infoCarta,10,10,c[contOpen].x,c[contOpen].y);
						cuadro(c[contOpen].x,c[contOpen].y,10,10,15);	
						contOpen++;
						gotoxy(71,6);
						printf("Carta 2: %d",c[contOpen].infoCarta);
						gotoxy(71,7);
						printf("Movimientos: %d",movs);
					}
					if(contOpen==2)
					{
						if(c[0].infoCarta==c[1].infoCarta)
						{
							//checkabiertas[c[0].infoCarta]=1;
							gotoxy(71,8);
							contOpen=0;
							pares++;
							printf("Pares encontrados: %d",pares);
						}
						else//Desmarcar la carta
						{
							Sleep(300);
							//desmarcar las cartas
							checkTabla[c[0].i][c[0].j]=0;	
							checkTabla[c[1].i][c[1].j]=0;
							//Borra el numero carta 1
							selecPixel(10,10,10,c[0].x,c[0].y);
							cuadro(c[0].x,c[0].y,10,10,15);
							//Borra el numero carta 2	
							selecPixel(10,10,10,c[1].x,c[1].y);
							cuadro(c[1].x,c[1].y,10,10,15);
							contOpen=0;
						}
						movs++;
				   }
				}
				break;	
		}
		cuadro(x,y,ancho,alto,2);
	}while(tecla!=27 && pares<10);
	if(pares==10){
	        pares=0;
	        system("MODE 80,46");
	        screen(win,45,88,0,0);
	        SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),240);
			gotoxy(3,40);
			printf("Nombre:");
			scanf("%s",userName);
			sndPlaySound(NULL, SND_ASYNC | SND_FILENAME | SND_ASYNC);
			readPlayers(nomArch,users);				
			ordenaPlayers(userName,movs,users);
			savePlayers(nomArch,users);
			movs=0;
	}
	
}

void asignaCartas(int infoTabla[4][5])
{
	int check[10]={0};//Ningun valor asignado
	int i=0, num=0, j=0;
	
	for(i=0;i<4;i++)
	{
		for(j=0;j<5;j++)
		{
			do{
			num=rand()%10;
			}while(check[num]==2);
			check[num]++;//Asignar 2 veces el numero de una carta  
			infoTabla[i][j]=num;//Se asigna a la tabla
		}
	}	
}
