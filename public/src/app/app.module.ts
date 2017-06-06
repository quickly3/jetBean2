import { NgModule } from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';
import { App }     from './app.component';
import { routing } from './app.routing';
import { HttpModule, JsonpModule } from '@angular/http';


import { AppMenu } from './layouts/app-menu.component';

import { BlogModule } from './blog/blog.module';
  

import { BlogService } from './services/blog.service';


// import { ModalModule } from 'ngx-bootstrap/modal';


@NgModule({
  bootstrap: [App],
  imports: [
    BrowserModule,
    BlogModule,
    routing,
    HttpModule,
    JsonpModule,

  ],
  declarations: [
    App,
    AppMenu
  ],
  providers:[
    BlogService
  ]
})
export class AppModule { }
