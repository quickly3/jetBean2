import { NgModule } from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';
import { App }     from './app.component';
import { routing } from './app.routing';
import { AppMenu } from './layouts/app-menu.component';
import { BlogModule } from './blog/blog.module';

// import { ModalModule } from 'ngx-bootstrap/modal';


@NgModule({
  bootstrap: [App],
  imports: [
    BrowserModule,
    BlogModule,
    routing,
  ],
  declarations: [
    App,
    AppMenu
  ],

})
export class AppModule { }
