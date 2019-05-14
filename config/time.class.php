<?php
class Timer{
    private $elapsedTime;
    public function start()
    {
        if( !$this->elapsedTime = $this->getMicrotime() )
        {
            throw new Exception( 'Error obtaining start time!' );
        };
    }
    public function stop()
    {
        if( !$this->elapsedTime = round( $this->getMicrotime() - $this->elapsedTime , 10 ) )
        {
            throw new Exception( 'Error obtaining stop time!' );
        };
        return $this->elapsedTime;
    }
    private function getMicrotime()
    {
        list( $useg , $seg ) = explode( ' ' , microtime() );
        return ( (float)$useg + (float)$seg );
    }
};
?>