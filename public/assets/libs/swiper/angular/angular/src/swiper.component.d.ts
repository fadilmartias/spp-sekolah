import { ChangeDetectorRef, ElementRef, EventEmitter, NgZone, OnInit, QueryList, SimpleChanges } from '@angular/core';
import Swiper from 'swiper';
import { Observable, Subject } from 'rxjs';
import { SwiperSlideDirective } from './swiper-slide.directive';
import { SwiperOptions, NavigationOptions, PaginationOptions, ScrollbarOptions, VirtualOptions } from 'swiper/types';
import * as i0 from "@angular/core";
export declare class SwiperComponent implements OnInit {
    private _ngZone;
    private elementRef;
    private _changeDetectorRef;
    private _platformId;
    enabled: SwiperOptions['enabled'];
    on: SwiperOptions['on'];
    direction: SwiperOptions['direction'];
    touchEventsTarget: SwiperOptions['touchEventsTarget'];
    initialSlide: SwiperOptions['initialSlide'];
    speed: SwiperOptions['speed'];
    cssMode: SwiperOptions['cssMode'];
    updateOnWindowResize: SwiperOptions['updateOnWindowResize'];
    resizeObserver: SwiperOptions['resizeObserver'];
    nested: SwiperOptions['nested'];
    focusableElements: SwiperOptions['focusableElements'];
    width: SwiperOptions['width'];
    height: SwiperOptions['height'];
    preventInteractionOnTransition: SwiperOptions['preventInteractionOnTransition'];
    userAgent: SwiperOptions['userAgent'];
    url: SwiperOptions['url'];
    edgeSwipeDetection: boolean | string;
    edgeSwipeThreshold: number;
    freeMode: SwiperOptions['freeMode'];
    autoHeight: SwiperOptions['autoHeight'];
    setWrapperSize: SwiperOptions['setWrapperSize'];
    virtualTranslate: SwiperOptions['virtualTranslate'];
    effect: SwiperOptions['effect'];
    breakpoints: SwiperOptions['breakpoints'];
    spaceBetween: SwiperOptions['spaceBetween'];
    slidesPerView: SwiperOptions['slidesPerView'];
    maxBackfaceHiddenSlides: SwiperOptions['maxBackfaceHiddenSlides'];
    grid: SwiperOptions['grid'];
    slidesPerGroup: SwiperOptions['slidesPerGroup'];
    slidesPerGroupSkip: SwiperOptions['slidesPerGroupSkip'];
    centeredSlides: SwiperOptions['centeredSlides'];
    centeredSlidesBounds: SwiperOptions['centeredSlidesBounds'];
    slidesOffsetBefore: SwiperOptions['slidesOffsetBefore'];
    slidesOffsetAfter: SwiperOptions['slidesOffsetAfter'];
    normalizeSlideIndex: SwiperOptions['normalizeSlideIndex'];
    centerInsufficientSlides: SwiperOptions['centerInsufficientSlides'];
    watchOverflow: SwiperOptions['watchOverflow'];
    roundLengths: SwiperOptions['roundLengths'];
    touchRatio: SwiperOptions['touchRatio'];
    touchAngle: SwiperOptions['touchAngle'];
    simulateTouch: SwiperOptions['simulateTouch'];
    shortSwipes: SwiperOptions['shortSwipes'];
    longSwipes: SwiperOptions['longSwipes'];
    longSwipesRatio: SwiperOptions['longSwipesRatio'];
    longSwipesMs: SwiperOptions['longSwipesMs'];
    followFinger: SwiperOptions['followFinger'];
    allowTouchMove: SwiperOptions['allowTouchMove'];
    threshold: SwiperOptions['threshold'];
    touchMoveStopPropagation: SwiperOptions['touchMoveStopPropagation'];
    touchStartPreventDefault: SwiperOptions['touchStartPreventDefault'];
    touchStartForcePreventDefault: SwiperOptions['touchStartForcePreventDefault'];
    touchReleaseOnEdges: SwiperOptions['touchReleaseOnEdges'];
    uniqueNavElements: SwiperOptions['uniqueNavElements'];
    resistance: SwiperOptions['resistance'];
    resistanceRatio: SwiperOptions['resistanceRatio'];
    watchSlidesProgress: SwiperOptions['watchSlidesProgress'];
    grabCursor: SwiperOptions['grabCursor'];
    preventClicks: SwiperOptions['preventClicks'];
    preventClicksPropagation: SwiperOptions['preventClicksPropagation'];
    slideToClickedSlide: SwiperOptions['slideToClickedSlide'];
    preloadImages: SwiperOptions['preloadImages'];
    updateOnImagesReady: SwiperOptions['updateOnImagesReady'];
    loop: SwiperOptions['loop'];
    loopAdditionalSlides: SwiperOptions['loopAdditionalSlides'];
    loopedSlides: SwiperOptions['loopedSlides'];
    loopedSlidesLimit: SwiperOptions['loopedSlidesLimit'];
    loopFillGroupWithBlank: SwiperOptions['loopFillGroupWithBlank'];
    loopPreventsSlide: SwiperOptions['loopPreventsSlide'];
    rewind: SwiperOptions['rewind'];
    allowSlidePrev: SwiperOptions['allowSlidePrev'];
    allowSlideNext: SwiperOptions['allowSlideNext'];
    swipeHandler: SwiperOptions['swipeHandler'];
    noSwiping: SwiperOptions['noSwiping'];
    noSwipingClass: SwiperOptions['noSwipingClass'];
    noSwipingSelector: SwiperOptions['noSwipingSelector'];
    passiveListeners: SwiperOptions['passiveListeners'];
    containerModifierClass: SwiperOptions['containerModifierClass'];
    slideClass: SwiperOptions['slideClass'];
    slideBlankClass: SwiperOptions['slideBlankClass'];
    slideActiveClass: SwiperOptions['slideActiveClass'];
    slideDuplicateActiveClass: SwiperOptions['slideDuplicateActiveClass'];
    slideVisibleClass: SwiperOptions['slideVisibleClass'];
    slideDuplicateClass: SwiperOptions['slideDuplicateClass'];
    slideNextClass: SwiperOptions['slideNextClass'];
    slideDuplicateNextClass: SwiperOptions['slideDuplicateNextClass'];
    slidePrevClass: SwiperOptions['slidePrevClass'];
    slideDuplicatePrevClass: SwiperOptions['slideDuplicatePrevClass'];
    wrapperClass: SwiperOptions['wrapperClass'];
    runCallbacksOnInit: SwiperOptions['runCallbacksOnInit'];
    observeParents: SwiperOptions['observeParents'];
    observeSlideChildren: SwiperOptions['observeSlideChildren'];
    a11y: SwiperOptions['a11y'];
    autoplay: SwiperOptions['autoplay'];
    controller: SwiperOptions['controller'];
    coverflowEffect: SwiperOptions['coverflowEffect'];
    cubeEffect: SwiperOptions['cubeEffect'];
    fadeEffect: SwiperOptions['fadeEffect'];
    flipEffect: SwiperOptions['flipEffect'];
    creativeEffect: SwiperOptions['creativeEffect'];
    cardsEffect: SwiperOptions['cardsEffect'];
    hashNavigation: SwiperOptions['hashNavigation'];
    history: SwiperOptions['history'];
    keyboard: SwiperOptions['keyboard'];
    lazy: SwiperOptions['lazy'];
    mousewheel: SwiperOptions['mousewheel'];
    parallax: SwiperOptions['parallax'];
    thumbs: SwiperOptions['thumbs'];
    zoom: SwiperOptions['zoom'];
    class: string;
    id: string;
    set navigation(val: boolean | "" | NavigationOptions);
    get navigation(): boolean | "" | NavigationOptions;
    private _navigation;
    showNavigation: boolean;
    set pagination(val: boolean | "" | PaginationOptions);
    get pagination(): boolean | "" | PaginationOptions;
    private _pagination;
    showPagination: boolean;
    set scrollbar(val: boolean | "" | ScrollbarOptions);
    get scrollbar(): boolean | "" | ScrollbarOptions;
    private _scrollbar;
    showScrollbar: boolean;
    set virtual(val: boolean | "" | VirtualOptions);
    get virtual(): boolean | "" | VirtualOptions;
    private _virtual;
    set config(val: SwiperOptions);
    s__beforeBreakpoint: EventEmitter<[swiper: Swiper, breakpointParams: SwiperOptions]>;
    s__containerClasses: EventEmitter<[swiper: Swiper, classNames: string]>;
    s__slideClass: EventEmitter<[swiper: Swiper, slideEl: HTMLElement, classNames: string]>;
    s__swiper: EventEmitter<[swiper: Swiper]>;
    s_activeIndexChange: EventEmitter<[swiper: Swiper]>;
    s_afterInit: EventEmitter<[swiper: Swiper]>;
    s_autoplay: EventEmitter<[swiper: Swiper]>;
    s_autoplayStart: EventEmitter<[swiper: Swiper]>;
    s_autoplayStop: EventEmitter<[swiper: Swiper]>;
    s_autoplayPause: EventEmitter<[swiper: Swiper]>;
    s_autoplayResume: EventEmitter<[swiper: Swiper]>;
    s_beforeDestroy: EventEmitter<[swiper: Swiper]>;
    s_beforeInit: EventEmitter<[swiper: Swiper]>;
    s_beforeLoopFix: EventEmitter<[swiper: Swiper]>;
    s_beforeResize: EventEmitter<[swiper: Swiper]>;
    s_beforeSlideChangeStart: EventEmitter<[swiper: Swiper]>;
    s_beforeTransitionStart: EventEmitter<[swiper: Swiper, speed: number, internal: any]>;
    s_breakpoint: EventEmitter<[swiper: Swiper, breakpointParams: SwiperOptions]>;
    s_changeDirection: EventEmitter<[swiper: Swiper]>;
    s_click: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_doubleTap: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_doubleClick: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_destroy: EventEmitter<[swiper: Swiper]>;
    s_fromEdge: EventEmitter<[swiper: Swiper]>;
    s_hashChange: EventEmitter<[swiper: Swiper]>;
    s_hashSet: EventEmitter<[swiper: Swiper]>;
    s_imagesReady: EventEmitter<[swiper: Swiper]>;
    s_init: EventEmitter<[swiper: Swiper]>;
    s_keyPress: EventEmitter<[swiper: Swiper, keyCode: string]>;
    s_lazyImageLoad: EventEmitter<[swiper: Swiper, slideEl: HTMLElement, imageEl: HTMLElement]>;
    s_lazyImageReady: EventEmitter<[swiper: Swiper, slideEl: HTMLElement, imageEl: HTMLElement]>;
    s_loopFix: EventEmitter<[swiper: Swiper]>;
    s_momentumBounce: EventEmitter<[swiper: Swiper]>;
    s_navigationHide: EventEmitter<[swiper: Swiper]>;
    s_navigationShow: EventEmitter<[swiper: Swiper]>;
    s_navigationPrev: EventEmitter<[swiper: Swiper]>;
    s_navigationNext: EventEmitter<[swiper: Swiper]>;
    s_observerUpdate: EventEmitter<[swiper: Swiper]>;
    s_orientationchange: EventEmitter<[swiper: Swiper]>;
    s_paginationHide: EventEmitter<[swiper: Swiper]>;
    s_paginationRender: EventEmitter<[swiper: Swiper, paginationEl: HTMLElement]>;
    s_paginationShow: EventEmitter<[swiper: Swiper]>;
    s_paginationUpdate: EventEmitter<[swiper: Swiper, paginationEl: HTMLElement]>;
    s_progress: EventEmitter<[swiper: Swiper, progress: number]>;
    s_reachBeginning: EventEmitter<[swiper: Swiper]>;
    s_reachEnd: EventEmitter<[swiper: Swiper]>;
    s_realIndexChange: EventEmitter<[swiper: Swiper]>;
    s_resize: EventEmitter<[swiper: Swiper]>;
    s_scroll: EventEmitter<[swiper: Swiper, event: WheelEvent]>;
    s_scrollbarDragEnd: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_scrollbarDragMove: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_scrollbarDragStart: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_setTransition: EventEmitter<[swiper: Swiper, transition: number]>;
    s_setTranslate: EventEmitter<[swiper: Swiper, translate: number]>;
    s_slideChange: EventEmitter<[swiper: Swiper]>;
    s_slideChangeTransitionEnd: EventEmitter<[swiper: Swiper]>;
    s_slideChangeTransitionStart: EventEmitter<[swiper: Swiper]>;
    s_slideNextTransitionEnd: EventEmitter<[swiper: Swiper]>;
    s_slideNextTransitionStart: EventEmitter<[swiper: Swiper]>;
    s_slidePrevTransitionEnd: EventEmitter<[swiper: Swiper]>;
    s_slidePrevTransitionStart: EventEmitter<[swiper: Swiper]>;
    s_slideResetTransitionStart: EventEmitter<[swiper: Swiper]>;
    s_slideResetTransitionEnd: EventEmitter<[swiper: Swiper]>;
    s_sliderMove: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_sliderFirstMove: EventEmitter<[swiper: Swiper, event: TouchEvent]>;
    s_slidesLengthChange: EventEmitter<[swiper: Swiper]>;
    s_slidesGridLengthChange: EventEmitter<[swiper: Swiper]>;
    s_snapGridLengthChange: EventEmitter<[swiper: Swiper]>;
    s_snapIndexChange: EventEmitter<[swiper: Swiper]>;
    s_tap: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_toEdge: EventEmitter<[swiper: Swiper]>;
    s_touchEnd: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_touchMove: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_touchMoveOpposite: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_touchStart: EventEmitter<[swiper: Swiper, event: PointerEvent | MouseEvent | TouchEvent]>;
    s_transitionEnd: EventEmitter<[swiper: Swiper]>;
    s_transitionStart: EventEmitter<[swiper: Swiper]>;
    s_update: EventEmitter<[swiper: Swiper]>;
    s_zoomChange: EventEmitter<[swiper: Swiper, scale: number, imageEl: HTMLElement, slideEl: HTMLElement]>;
    s_swiper: EventEmitter<any>;
    s_lock: EventEmitter<[swiper: Swiper]>;
    s_unlock: EventEmitter<[swiper: Swiper]>;
    set prevElRef(el: ElementRef);
    _prevElRef: ElementRef;
    set nextElRef(el: ElementRef);
    _nextElRef: ElementRef;
    set scrollbarElRef(el: ElementRef);
    _scrollbarElRef: ElementRef;
    set paginationElRef(el: ElementRef);
    _paginationElRef: ElementRef;
    slidesEl: QueryList<SwiperSlideDirective>;
    private slides;
    prependSlides: Observable<SwiperSlideDirective[]>;
    appendSlides: Observable<SwiperSlideDirective[]>;
    swiperRef: Swiper;
    readonly _activeSlides: Subject<SwiperSlideDirective[]>;
    get activeSlides(): Observable<SwiperSlideDirective[]>;
    get zoomContainerClass(): string;
    containerClasses: string;
    constructor(_ngZone: NgZone, elementRef: ElementRef, _changeDetectorRef: ChangeDetectorRef, _platformId: Object);
    private _setElement;
    ngOnInit(): void;
    ngAfterViewInit(): void;
    private childrenSlidesInit;
    private slidesChanges;
    get isSwiperActive(): boolean;
    initSwiper(): void;
    style: any;
    currentVirtualData: any;
    private updateVirtualSlides;
    ngOnChanges(changedParams: SimpleChanges): void;
    updateInitSwiper(changedParams: any): void;
    updateSwiper(changedParams: SimpleChanges | any): void;
    calcLoopedSlides(): number | boolean;
    updateParameter(key: string, value: any): void;
    ngOnDestroy(): void;
    static ɵfac: i0.ɵɵFactoryDeclaration<SwiperComponent, never>;
    static ɵcmp: i0.ɵɵComponentDeclaration<SwiperComponent, "swiper, [swiper]", never, { "enabled": "enabled"; "on": "on"; "direction": "direction"; "touchEventsTarget": "touchEventsTarget"; "initialSlide": "initialSlide"; "speed": "speed"; "cssMode": "cssMode"; "updateOnWindowResize": "updateOnWindowResize"; "resizeObserver": "resizeObserver"; "nested": "nested"; "focusableElements": "focusableElements"; "width": "width"; "height": "height"; "preventInteractionOnTransition": "preventInteractionOnTransition"; "userAgent": "userAgent"; "url": "url"; "edgeSwipeDetection": "edgeSwipeDetection"; "edgeSwipeThreshold": "edgeSwipeThreshold"; "freeMode": "freeMode"; "autoHeight": "autoHeight"; "setWrapperSize": "setWrapperSize"; "virtualTranslate": "virtualTranslate"; "effect": "effect"; "breakpoints": "breakpoints"; "spaceBetween": "spaceBetween"; "slidesPerView": "slidesPerView"; "maxBackfaceHiddenSlides": "maxBackfaceHiddenSlides"; "grid": "grid"; "slidesPerGroup": "slidesPerGroup"; "slidesPerGroupSkip": "slidesPerGroupSkip"; "centeredSlides": "centeredSlides"; "centeredSlidesBounds": "centeredSlidesBounds"; "slidesOffsetBefore": "slidesOffsetBefore"; "slidesOffsetAfter": "slidesOffsetAfter"; "normalizeSlideIndex": "normalizeSlideIndex"; "centerInsufficientSlides": "centerInsufficientSlides"; "watchOverflow": "watchOverflow"; "roundLengths": "roundLengths"; "touchRatio": "touchRatio"; "touchAngle": "touchAngle"; "simulateTouch": "simulateTouch"; "shortSwipes": "shortSwipes"; "longSwipes": "longSwipes"; "longSwipesRatio": "longSwipesRatio"; "longSwipesMs": "longSwipesMs"; "followFinger": "followFinger"; "allowTouchMove": "allowTouchMove"; "threshold": "threshold"; "touchMoveStopPropagation": "touchMoveStopPropagation"; "touchStartPreventDefault": "touchStartPreventDefault"; "touchStartForcePreventDefault": "touchStartForcePreventDefault"; "touchReleaseOnEdges": "touchReleaseOnEdges"; "uniqueNavElements": "uniqueNavElements"; "resistance": "resistance"; "resistanceRatio": "resistanceRatio"; "watchSlidesProgress": "watchSlidesProgress"; "grabCursor": "grabCursor"; "preventClicks": "preventClicks"; "preventClicksPropagation": "preventClicksPropagation"; "slideToClickedSlide": "slideToClickedSlide"; "preloadImages": "preloadImages"; "updateOnImagesReady": "updateOnImagesReady"; "loop": "loop"; "loopAdditionalSlides": "loopAdditionalSlides"; "loopedSlides": "loopedSlides"; "loopedSlidesLimit": "loopedSlidesLimit"; "loopFillGroupWithBlank": "loopFillGroupWithBlank"; "loopPreventsSlide": "loopPreventsSlide"; "rewind": "rewind"; "allowSlidePrev": "allowSlidePrev"; "allowSlideNext": "allowSlideNext"; "swipeHandler": "swipeHandler"; "noSwiping": "noSwiping"; "noSwipingClass": "noSwipingClass"; "noSwipingSelector": "noSwipingSelector"; "passiveListeners": "passiveListeners"; "containerModifierClass": "containerModifierClass"; "slideClass": "slideClass"; "slideBlankClass": "slideBlankClass"; "slideActiveClass": "slideActiveClass"; "slideDuplicateActiveClass": "slideDuplicateActiveClass"; "slideVisibleClass": "slideVisibleClass"; "slideDuplicateClass": "slideDuplicateClass"; "slideNextClass": "slideNextClass"; "slideDuplicateNextClass": "slideDuplicateNextClass"; "slidePrevClass": "slidePrevClass"; "slideDuplicatePrevClass": "slideDuplicatePrevClass"; "wrapperClass": "wrapperClass"; "runCallbacksOnInit": "runCallbacksOnInit"; "observeParents": "observeParents"; "observeSlideChildren": "observeSlideChildren"; "a11y": "a11y"; "autoplay": "autoplay"; "controller": "controller"; "coverflowEffect": "coverflowEffect"; "cubeEffect": "cubeEffect"; "fadeEffect": "fadeEffect"; "flipEffect": "flipEffect"; "creativeEffect": "creativeEffect"; "cardsEffect": "cardsEffect"; "hashNavigation": "hashNavigation"; "history": "history"; "keyboard": "keyboard"; "lazy": "lazy"; "mousewheel": "mousewheel"; "parallax": "parallax"; "thumbs": "thumbs"; "zoom": "zoom"; "class": "class"; "id": "id"; "navigation": "navigation"; "pagination": "pagination"; "scrollbar": "scrollbar"; "virtual": "virtual"; "config": "config"; }, { "s__beforeBreakpoint": "_beforeBreakpoint"; "s__containerClasses": "_containerClasses"; "s__slideClass": "_slideClass"; "s__swiper": "_swiper"; "s_activeIndexChange": "activeIndexChange"; "s_afterInit": "afterInit"; "s_autoplay": "autoplay"; "s_autoplayStart": "autoplayStart"; "s_autoplayStop": "autoplayStop"; "s_autoplayPause": "autoplayPause"; "s_autoplayResume": "autoplayResume"; "s_beforeDestroy": "beforeDestroy"; "s_beforeInit": "beforeInit"; "s_beforeLoopFix": "beforeLoopFix"; "s_beforeResize": "beforeResize"; "s_beforeSlideChangeStart": "beforeSlideChangeStart"; "s_beforeTransitionStart": "beforeTransitionStart"; "s_breakpoint": "breakpoint"; "s_changeDirection": "changeDirection"; "s_click": "click"; "s_doubleTap": "doubleTap"; "s_doubleClick": "doubleClick"; "s_destroy": "destroy"; "s_fromEdge": "fromEdge"; "s_hashChange": "hashChange"; "s_hashSet": "hashSet"; "s_imagesReady": "imagesReady"; "s_init": "init"; "s_keyPress": "keyPress"; "s_lazyImageLoad": "lazyImageLoad"; "s_lazyImageReady": "lazyImageReady"; "s_loopFix": "loopFix"; "s_momentumBounce": "momentumBounce"; "s_navigationHide": "navigationHide"; "s_navigationShow": "navigationShow"; "s_navigationPrev": "navigationPrev"; "s_navigationNext": "navigationNext"; "s_observerUpdate": "observerUpdate"; "s_orientationchange": "orientationchange"; "s_paginationHide": "paginationHide"; "s_paginationRender": "paginationRender"; "s_paginationShow": "paginationShow"; "s_paginationUpdate": "paginationUpdate"; "s_progress": "progress"; "s_reachBeginning": "reachBeginning"; "s_reachEnd": "reachEnd"; "s_realIndexChange": "realIndexChange"; "s_resize": "resize"; "s_scroll": "scroll"; "s_scrollbarDragEnd": "scrollbarDragEnd"; "s_scrollbarDragMove": "scrollbarDragMove"; "s_scrollbarDragStart": "scrollbarDragStart"; "s_setTransition": "setTransition"; "s_setTranslate": "setTranslate"; "s_slideChange": "slideChange"; "s_slideChangeTransitionEnd": "slideChangeTransitionEnd"; "s_slideChangeTransitionStart": "slideChangeTransitionStart"; "s_slideNextTransitionEnd": "slideNextTransitionEnd"; "s_slideNextTransitionStart": "slideNextTransitionStart"; "s_slidePrevTransitionEnd": "slidePrevTransitionEnd"; "s_slidePrevTransitionStart": "slidePrevTransitionStart"; "s_slideResetTransitionStart": "slideResetTransitionStart"; "s_slideResetTransitionEnd": "slideResetTransitionEnd"; "s_sliderMove": "sliderMove"; "s_sliderFirstMove": "sliderFirstMove"; "s_slidesLengthChange": "slidesLengthChange"; "s_slidesGridLengthChange": "slidesGridLengthChange"; "s_snapGridLengthChange": "snapGridLengthChange"; "s_snapIndexChange": "snapIndexChange"; "s_tap": "tap"; "s_toEdge": "toEdge"; "s_touchEnd": "touchEnd"; "s_touchMove": "touchMove"; "s_touchMoveOpposite": "touchMoveOpposite"; "s_touchStart": "touchStart"; "s_transitionEnd": "transitionEnd"; "s_transitionStart": "transitionStart"; "s_update": "update"; "s_zoomChange": "zoomChange"; "s_swiper": "swiper"; "s_lock": "lock"; "s_unlock": "unlock"; }, ["slidesEl"], ["[slot=container-start]", "[slot=wrapper-start]", "[slot=wrapper-end]", "[slot=container-end]"]>;
}