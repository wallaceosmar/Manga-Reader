<?php

/* 
 * The MIT License
 *
 * Copyright 2016 Wallace Osmar https://github.com/wallaceosmar.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

global $_app, $_core, $_routing, $_template, $_dispatch, $_storeCache, $_navbar_;

/**
 *
 * @global Routing $GLOBALS['_routing']
 * @name $_routing 
 */
$GLOBALS['_routing'] = new Routing();

/**
 *
 * @global Smarty $GLOBALS['_template']
 * @name $_template 
 */
$GLOBALS['_template'] = new Smarty();
$_template->caching = true;
$_template->cache_lifetime = defined( 'TEMPLATE_CACHE_LIFETIME' ) ? TEMPLATE_CACHE_LIFETIME : 120 ;
$_template->cache_dir = DATA_CAHCE_PATH;
$_template->compile_dir  = DATA_TEMPLATE_PATH;

/**
 *
 * @global Dispatcher $GLOBALS['_dispatch']
 * @name $_dispatch 
 */
$GLOBALS['_dispatch'] = new Dispatcher( $GLOBALS['_routing'] );

/**
 *
 * @global StorageCache $GLOBALS['_storeCache']
 * @name $_storeCache 
 */
$GLOBALS['_storeCache'] = new StorageCache();

/**
 *
 * @global Menu $GLOBALS['_navbar_']
 * @name $_navbar_ 
 */
$GLOBALS['_navbar_'] = new Menu();