import { 
	Component
} from '@angular/core';

import { Routes,Router,ActivatedRoute, Params } from '@angular/router';

import { BlogService } from '../services/blog.service';

import * as $ from 'jquery';

import { ExPage } from "../common/pagination.component";

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
	id:any
	page:any

	_nav_width = 0;

	constructor (
		private blogService: BlogService,  
		private route: ActivatedRoute,
		private router: Router,
		) {
		this.id = route.snapshot.params.id;
		this.page = {
			currPage:0,
			totalPage:0,
			items:0,
			rows:10
		}
	}

	toPage(blogId:any){
		this.id = blogId;
		this.router.navigate(['/blog/'+blogId]);
		this.getBlogInfo();
	}

	getBlogInfo(){
		this.blogService.getBlog({id:this.id}).subscribe(res=> {
			for(let i in res){
				this[i] = res[i];
			}
			this.page.items = res.blogCnt;
			this.page.currPage = 1;
			this.page.totalPage = Math.ceil(this.page.items / this.page.rows);
        });
	}

	ngOnInit(){
		this.getBlogInfo();
	}

	ngAfterViewInit(){
		this._nav_width = $(".blog-posts-tab").width() -20;

		
	}

	ngAfterViewChecked(){
		$(".random-blog-item").css({width:this._nav_width+"px"});
				
	}

}