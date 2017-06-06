import { 
	Component,
    Input
} from '@angular/core';

@Component({
    selector:"ex-page",
    template:` <div class="blog-paging" data-curr="(($blogList->currentPage()))"
                                 data-total="(($blogList->total()))"
                                 data-perPage="(($blogList->perPage ()))">
            <a class="background-color" href="#">First</a>
            <a class="background-color" href="#">...</a>

            <a class="background-color" href="#">6</a>
            <a class="background-color" href="#">7</a>
            <a class="background-color" href="#">8</a>

            <a class="background-color" href="#">...</a>
            <a class="background-color" href="#">Last</a>
        </div>`
})

export class ExPage{

    @Input() currPage:number
    @Input() totalPage:number

    constructor(){}
    
    ngAfterViewChecked(){
        console.log(this.currPage);
        console.log(this.totalPage);
        
    }
}