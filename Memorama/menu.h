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
 	 SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),15);
	 gotoxy(posX,posY);printf("1. APLICACION");
	 gotoxy(posX,++posY);printf("2. AYUDA");
	 gotoxy(posX,++posY);printf("3. SCORE");
	 gotoxy(posX,++posY);printf("4. SALIR");	 	 
}

int scroll_menu(int posX, int posY, int cantOpc)
{
 char tecla='\0';
 int op=1,y=posY;
 
 posX=posX-2;
 SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),10);	
 gotoxy(posX,posY); 
 printf(">>");
 do{
 	tecla=getch(); 	
 	SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),0);
 	gotoxy(posX,y);
	printf(">>");
 	if(tecla==80 && op<cantOpc)// 'P' 80 ABAJO
 	{ 	y++;
		op++;
 	}
 	if(tecla==72 && op>1)//'H' ARRIBA
 	{ 	y--;
		op--;
 	}
 	SetConsoleTextAttribute(GetStdHandle (STD_OUTPUT_HANDLE),10);
 	gotoxy(posX,y);
	printf(">>");
 }while(tecla!=27 && tecla!=13);//ESC 27   ENTER 13
 return (op);
}

