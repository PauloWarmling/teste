<?php

// Interface base para o relatório
interface Report
{
    public function generate(): string;
}

// Implementação concreta do relatório simples
class SimpleReport implements Report
{
    public function generate(): string
    {
        return "Conteúdo do relatório";
    }
}

// Classe abstrata do Decorator (implementa a interface Report)
abstract class ReportDecorator implements Report
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function generate(): string
    {
        return $this->report->generate();
    }
}

// Decorator para adicionar bordas
class BorderDecorator extends ReportDecorator
{
    public function generate(): string
    {
        return "<div style='border: 1px solid black; padding: 10px;'>" . 
               $this->report->generate() . 
               "</div>";
    }
}

// Decorator para adicionar cabeçalho
class HeaderDecorator extends ReportDecorator
{
    private $header;

    public function __construct(Report $report, string $header)
    {
        parent::__construct($report);
        $this->header = $header;
    }

    public function generate(): string
    {
        return "<h1>{$this->header}</h1>" . $this->report->generate();
    }
}

// Decorator para mudar cor do texto
class ColorDecorator extends ReportDecorator
{
    private $color;

    public function __construct(Report $report, string $color)
    {
        parent::__construct($report);
        $this->color = $color;
    }

    public function generate(): string
    {
        return "<div style='color: {$this->color};'>" . 
               $this->report->generate() . 
               "</div>";
    }
}

// Exemplo de uso
$baseReport = new SimpleReport(); // Relatório base
$reportWithBorder = new BorderDecorator($baseReport); // Adiciona borda
$reportWithHeader = new HeaderDecorator($reportWithBorder, "Relatório Mensal"); // Adiciona cabeçalho
$finalReport = new ColorDecorator($reportWithHeader, "blue"); // Adiciona cor azul

echo $finalReport->generate();

?>
