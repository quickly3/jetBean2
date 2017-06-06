import { 
	Component
} from '@angular/core';

import { Routes } from '@angular/router';
import { BlogService } from '../services/blog.service';

import * as $ from 'jquery';



@Component({
	selector:"blog",
	templateUrl:'./blog.component.html',
	styleUrls:['./blog.component.scss']
})

export class Blog {
	blogCnt:any
	blogInfo:any
	blogList:any
	categories:any
	curr_cate:any
	curr_tag:any
	popular:any
	recent:any
	tags:any

	_nav_width = 0;

	constructor (private blogService: BlogService) {
	}

	ngOnInit(){
		this.blogService.httpGet("http://127.0.0.1/Home/Blog/index",{}).subscribe(res=> {
			for(let i in res){
				this[i] = res[i];
			}
        });
	}

	ngAfterViewInit(){
		this._nav_width = $(".blog-posts-tab").width() -20;

		
	}

	ngAfterViewChecked(){
		$(".random-blog-item").css({width:this._nav_width+"px"});
				
	}

}