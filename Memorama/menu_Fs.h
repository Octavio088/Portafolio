#include<stdio.h>
#include<conio.h>
#include<windows.h>
#include<string.h>

/*void gotoxy(int x,int y){
      HANDLE hcon;  
      hcon = GetStdHandle(STD_OUTPUT_HANDLE);  
      COORD dwPos;  
      dwPos.X = x;  
      dwPos.Y= y;  
      SetConsoleCursorPosition(hcon,dwPos);  
}*/

void presenta_menu(int posX, int posY);
int scroll_menu(int posX, int posY, int cantOpc);

void presenta_menu(int posX, int posY)
{
 	 system("cls");
 	 system("MODE 84,47");
	sndPlaySound("pokemon.wav", SND_ASYNC | SND_FILENAME | SND_NOSTOP && SND_LOOP);
 /*	SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),15);
	 gotoxy(posX+10,posY+4);printf("1. APLICACION");
	 gotoxy(posX+10,posY+5);printf("2. AYUDA");
	 gotoxy(posX+10,posY+6);printf("3. SCORE");
	 gotoxy(posX+10,posY+7);printf("4. SALIR");*/	 	 
	 //pmenu(menu,29,65,posX,posY-1);
	 campo(Kane,45,92,0,0);
}

int scroll_menu(int posX, int posY, int cantOpc)
{
 char tecla='\0';
 int op=1,y=posY;
 posX=posX+10;
 //SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),10);	
 //gotoxy(posX,posY); 
 //printf(">>");
 flecha(arrow,9,9,posX,posY);
 do{
 	tecla=getch(); 	
 	SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),0);
 	//gotoxy(posX,y);
	//printf(">>");
	flecha(arrow2,9,9,posX,y);
 	if(tecla==80 && op<cantOpc)// 'P' 80 ABAJO
 	{ 	y=y+6;
		op++;
 	}
 	if(tecla==72 && op>1)//'H' ARRIBA
 	{ 	y=y-6;
		op--;
 	}
 	//SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),10);
 	flecha(arrow,9,9,posX,y);
	//gotoxy(posX,y);
	//printf(">>");
 }while(tecla!=27 && tecla!=13);//ESC 27   ENTER 13
 return (op);
}

