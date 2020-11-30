<?php

namespace Tests\Unit\Domain\Shared;

use Domain\Movies\Movie;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    public function testCreateMovie()
    {
        $movie = new Movie([
            'adult' => false,
            'backdrop_path' => '/ibw3MvF2GLHVcPJd2PDtOQcMDPq.jpg',
            'homepage' => 'http://www.eternalsunshine.com',
            'external_id' => '38',
            'imdb_id' => 'tt0338013',
            'original_language' => 'en',
            'original_title' => 'Eternal Sunshine of the Spotless Mind',
            'overview' => 'Joel se surpreende ao saber que seu amor verdadeiro, Clementine, o apagou completamente de sua memória. Ele decide fazer o mesmo, mas muda de ideia. Preso dentro da própria mente enquanto os especialistas se mantêm ocupados em seu apartamento, Joel precisa avisá-los para parar.',
            'popularity' => '32.584',
            'release_date' => '2004-03-19',
            'runtime' => '108',
            'status' => 'Released',
            'tagline' => 'Um filme para todos que têm um passado que gostariam de esquecer...',
            'title' => 'Brilho Eterno de uma Mente sem Lembranças',
            'video' => 0,
            'vote_count' => '10259',
        ]);

        $this->assertInstanceOf(Movie::class, $movie);

        $this->assertEquals(false, $movie->adult);
        $this->assertEquals('/ibw3MvF2GLHVcPJd2PDtOQcMDPq.jpg', $movie->backdrop_path);
        $this->assertEquals('http://www.eternalsunshine.com', $movie->homepage);
        $this->assertEquals('38', $movie->external_id);
        $this->assertEquals('tt0338013', $movie->imdb_id);
        $this->assertEquals('en', $movie->original_language);
        $this->assertEquals('Eternal Sunshine of the Spotless Mind', $movie->original_title);
        $this->assertEquals('Joel se surpreende ao saber que seu amor verdadeiro, Clementine, o apagou completamente de sua memória. Ele decide fazer o mesmo, mas muda de ideia. Preso dentro da própria mente enquanto os especialistas se mantêm ocupados em seu apartamento, Joel precisa avisá-los para parar.', $movie->overview);
        $this->assertEquals('32.584', $movie->popularity);
        $this->assertEquals('2004-03-19', $movie->release_date);
        $this->assertEquals('108', $movie->runtime);
        $this->assertEquals('Released', $movie->status);
        $this->assertEquals('Um filme para todos que têm um passado que gostariam de esquecer...', $movie->tagline);
        $this->assertEquals('Brilho Eterno de uma Mente sem Lembranças', $movie->title);
        $this->assertEquals(0, $movie->video);
        $this->assertEquals('10259', $movie->vote_count);
    }
}