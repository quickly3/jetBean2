import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { routing } from './blog.routing';
import { Blog } from './blog.component';

@NgModule({
  imports: [CommonModule, routing],
  declarations: [Blog]
})
export class BlogModule {
    
}
