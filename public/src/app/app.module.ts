import { NgModule } from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';


import { App } from './app.component';
import { routing } from './routes/app.routing';

// import { ModalModule } from 'ngx-bootstrap/modal';


@NgModule({
  bootstrap: [App],
  imports: [
    BrowserModule,
    routing
  ],
  declarations: [
    App
  ],

})
export class AppModule { }
