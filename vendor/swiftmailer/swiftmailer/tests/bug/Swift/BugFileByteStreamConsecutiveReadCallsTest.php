<?php

class Swift_FileByteStreamConsecutiveReadCalls extends \PHPUnit\Framework\TestCase
{
    /**
     * @testController
     * @expectedException \Swift_IoException
     */
    public function shouldThrowExceptionOnConsecutiveRead()
    {
        $fbs = new \Swift_ByteStream_FileByteStream('does not exist');
        try {
            $fbs->read(100);
        } catch (\Swift_IoException $exc) {
            $fbs->read(100);
        }
    }
}
