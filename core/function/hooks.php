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

$hooks = new Hooks();

/**
 * 
 * @global Hooks $hooks
 * @param string $tag
 * @param function $function_to_add
 * @param int $priority
 * @param int $accepted_args
 */
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
    global $hooks;
    
    $hooks->add_action($tag, $function_to_add, $priority, $accepted_args);
}

/**
 * 
 * @global Hooks $hooks
 * @param string $tag
 * @param mixed $hooks
 */
function apply_filters($tag, $hooks) {
    global $hooks;
    
    $hooks->apply_filters($tag, $hooks);
}

/**
 * 
 * @global Hooks $hooks
 * @param string $tag
 */
function do_action ( $tag ) {
    global $hooks;
    
    $hooks->do_action($tag);
}