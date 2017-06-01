import { NgModule } from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';


import { App } from './app.component';
import { routing } from './app.routing';
import { AppMenu } from './layouts/app-menu.component';

// import { ModalModule } from 'ngx-bootstrap/modal';


@NgModule({
  bootstrap: [App],
  imports: [
    BrowserModule,
    routing
  ],
  declarations: [
    App,
    AppMenu
  ],

})
export class AppModule { }
