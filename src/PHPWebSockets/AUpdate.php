<?php

declare(strict_types = 1);

/*
 * - - - - - - - - - - - - - BEGIN LICENSE BLOCK - - - - - - - - - - - - -
 * The MIT License (MIT)
 *
 * Copyright (c) 2018 Kevin Meijer
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * - - - - - - - - - - - - - - END LICENSE BLOCK - - - - - - - - - - - - -
 */

namespace PHPWebSockets;

abstract class AUpdate {

    /**
     * The source object related to this update
     *
     * @var \PHPWebSockets\AConnection|null
     */
    protected $_sourceConnection = NULL;

    /**
     * @var array|null
     */
    protected $_trace = NULL;

    /**
     * The code for this update
     *
     * @var int
     */
    protected $_code = 0;

    public function __construct(int $code, AConnection $sourceConnection = NULL) {

        $this->_sourceConnection = $sourceConnection;
        $this->_code = $code;

        if (\PHPWebSockets::ShouldUpdateTrace($this)) {
            $this->_trace = debug_backtrace(0);
        }

    }

    /**
     * Returns the connection that triggered this update
     *
     * @return \PHPWebSockets\AConnection|null
     */
    public function getSourceConnection() {
        return $this->_sourceConnection;
    }

    /**
     * Returns the source object related to this update
     *
     * @deprecated Use getSourceConnection instead
     *
     * @return object|null
     */
    public function getSourceObject() {
        return $this->_sourceConnection;
    }

    /**
     * @return array|null
     */
    public function getTrace() {
        return $this->_trace;
    }

    /**
     * Returns the code for this update
     *
     * @return int
     */
    public function getCode() : int {
        return $this->_code;
    }

    public function __toString() {
        return 'AUpdate) (C: ' . $this->getCode() . ')';
    }
}
