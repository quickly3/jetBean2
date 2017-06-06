import { Routes, RouterModule }  from '@angular/router';
import { Blog } from './blog.component';
import { ModuleWithProviders } from '@angular/core';
// noinspection TypeScriptValidateTypes

// export function loadChildren(path) { return System.import(path); };

export const routes: Routes = [
  {
    path: 'blog',
    component: Blog,
  },
    {
    path: 'blog/:id',
    component: Blog,
  }  
];

export const routing: ModuleWithProviders = RouterModule.forChild(routes);
