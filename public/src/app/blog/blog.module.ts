import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { routing } from './blog.routing';
import { Blog } from './blog.component';

import { ExPage } from '../common/pagination.component';


@NgModule({
  imports: [CommonModule, routing],
  declarations: [
    Blog,
    ExPage
  ]
})
export class BlogModule {
    
}
