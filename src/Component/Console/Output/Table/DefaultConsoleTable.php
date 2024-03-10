<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output\Table;

/**
 * DefaultConsoleTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Output\Table
*/
class DefaultConsoleTable implements ConsoleTableInterface
{
    /**
     * @inheritDoc
     */
    public function build(): mixed
    {
        // TODO: Implement build() method.
    }

    /**
     * @inheritDoc
     */
    public function addPadding(int $padding = 1): static
    {
        // TODO: Implement addPadding() method.
    }

    /**
     * @inheritDoc
     */
    public function addIndent(int $indent = 0): static
    {
        // TODO: Implement addIndent() method.
    }

    /**
     * @inheritDoc
     */
    public function addBorderLine(): static
    {
        // TODO: Implement addBorderLine() method.
    }

    /**
     * @inheritDoc
     */
    public function getBorderLine(): string
    {
        // TODO: Implement getBorderLine() method.
    }

    /**
     * @inheritDoc
     */
    public function hideBorder(): static
    {
        // TODO: Implement hideBorder() method.
    }

    /**
     * @inheritDoc
     */
    public function showBorder(): static
    {
        // TODO: Implement showBorder() method.
    }

    /**
     * @inheritDoc
     */
    public function showAllBorders(): static
    {
        // TODO: Implement showAllBorders() method.
    }

    /**
     * @inheritDoc
     */
    public function display(): void
    {
        // TODO: Implement display() method.
    }

    /**
     * @inheritDoc
     */
    public function addHeaders(array $headers): mixed
    {
        // TODO: Implement addHeaders() method.
    }

    /**
     * @inheritDoc
     */
    public function addHeader($header): mixed
    {
        // TODO: Implement addHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * @inheritDoc
     */
    public function addRows(array $rows): static
    {
        // TODO: Implement addRows() method.
    }

    /**
     * @inheritDoc
     */
    public function addRow(array $rows): static
    {
        // TODO: Implement addRow() method.
    }

    /**
     * @inheritDoc
     */
    public function getRows(): array
    {
        // TODO: Implement getRows() method.
    }

    /**
     * @inheritDoc
     */
    public function addColumn($row, $column, $content = null): static
    {
        // TODO: Implement addColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function addColumns(array $columns): static
    {
        // TODO: Implement addColumns() method.
    }

    /**
     * @inheritDoc
     */
    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
    }
}
