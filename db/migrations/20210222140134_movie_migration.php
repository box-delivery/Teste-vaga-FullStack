<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MovieMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('movies');
        $table
            ->addColumn('movie_id', 'integer')
            ->addColumn('title', 'string')
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['movie_id'], ['unique' => true])
            ->create();
    }
}
