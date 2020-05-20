import './blog.scss';
import $ from 'jquery';
import isotope from "../../../node_modules/isotope-layout/dist/isotope.pkgd";
import '../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';


var jQBridget = require('jquery-bridget');
var Packery = require('packery');
$.bridget( 'packery', Packery, $ );

var thereAreStillRecords = true;
var expectAnAnswer = false;
var intervalCounter = 0;
var intervalId = 0;

var gridList = $('#grid');

function reloadByInterval() {
    intervalId = setInterval(()=> {
        reloadGrid();

        window.instgrm.Embeds.process();
        if (intervalCounter++ === 20) clearInterval(intervalId);
    }, 100);
}

function initGrid() {
    if ($(window).width() >= '768' ){
        gridList.packery({
            itemSelector: '.grid-item',
            percentPosition: true
        });
    }

    //Get posts if end of grid in view
    $(window).on('scroll', () => {
        reloadGrid();
        if (isScrolledIntoView(gridList) && thereAreStillRecords && !expectAnAnswer) {
            expectAnAnswer = true;
            getNewPosts();
        }
    });

    reloadByInterval();

}

function getNewPosts() {
    let data = {
        action: 'morePosts',
        offset: $('.grid-item').length
    };
    try {
        if(mastak_ajax !== undefined){
            $.ajax({
                type: 'POST',
                url: mastak_ajax.ajax_url,
                data: data
            }).done((response) => {
                let buff = JSON.parse(response);

                if (Number(buff['status']) === 0)
                    thereAreStillRecords = false;

                let posts = $(buff['posts']);
                gridList.append( posts ).packery( 'appended', posts );
                reloadGrid();

                expectAnAnswer = false;
                reloadByInterval();

                // if ( typeof window.instgrm !== 'undefined' )
                //     window.instgrm.Embeds.process();

            }).fail((x, y, z) => console.log(x) );
        }
    }catch (err) {
        console.log(err);
        let item = `<div class="blog__grid-item grid-item">
                        <a href="#"> <h2>test title</h2> </a>
                        <div class="test_item" style=" height: 500px; background-color: black; "></div>
                    </div>`.repeat(5);
        let newItems = $( item);

        gridList.append( newItems ).packery( 'appended', newItems );
        reloadGrid();

    }
}
function reloadGrid() {
    gridList.packery( 'layout' );
}
function isScrolledIntoView(elem) {
    let docViewTop = $(window).scrollTop();
    let docViewBottom = docViewTop + $(window).height();

    let elemTop = $(elem).offset().top;
    let elemBottom = elemTop + $(elem).height();

    return elemBottom <= docViewBottom ;
}

initGrid();