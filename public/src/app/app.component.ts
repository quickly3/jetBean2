import { 
	OnInit,
	AfterViewChecked,
	Component,
	AfterViewInit 
} from '@angular/core';


import * as $ from 'jquery';
import { AppMenu } from './layouts/app-menu.component';


@Component({
	selector:"app",
	templateUrl:'./app.component.html',
	styleUrls:['./app.component.scss']
})

export class App implements OnInit, AfterViewChecked, AfterViewInit{

	ngOnInit() {
	
	}
	
	ngAfterViewInit() {
		this.buildRightSide();
		let foo = this.buildRightSide;
		$(window).resize(foo);
	}

	ngAfterViewChecked(){
		
	}

	buildRightSide(){
		let _window_width = $("html").width();
		let _menu_width = $("header").width();
		let _right_side_width = _window_width - _menu_width - 5;
		$(".rightSide").css({"width":_right_side_width+"px"});
	}

}