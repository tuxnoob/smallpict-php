<?php

declare(strict_types=1);

namespace SmallPict\Models;

class OptimizeOptions
{
    private string $format;
    private int $quality;
    private ?int $maxWidth;
    private ?int $maxHeight;
    private ?int $maxDimension;
    private string $fit;
    private bool $lossless;
    private bool $stripMetadata;
    private ?string $filename;
    private ?string $mimeType;
    private ?string $idempotencyKey;

    public function __construct(
        string $format = ImageFormat::AUTO,
        int $quality = 80,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        string $fit = FitMode::COVER,
        bool $lossless = false,
        bool $stripMetadata = true,
        ?string $filename = null,
        ?string $mimeType = null,
        ?string $idempotencyKey = null,
        ?int $maxDimension = null
    ) {
        $this->format = $format;
        $this->quality = max(1, min(100, $quality));
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
        $this->maxDimension = $maxDimension;
        $this->fit = $fit;
        $this->lossless = $lossless;
        $this->stripMetadata = $stripMetadata;
        $this->filename = $filename;
        $this->mimeType = $mimeType;
        $this->idempotencyKey = $idempotencyKey;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function getMaxWidth(): ?int
    {
        return $this->maxWidth;
    }

    public function getMaxHeight(): ?int
    {
        return $this->maxHeight;
    }

    public function getMaxDimension(): ?int
    {
        return $this->maxDimension;
    }

    public function getFit(): string
    {
        return $this->fit;
    }

    public function isLossless(): bool
    {
        return $this->lossless;
    }

    public function shouldStripMetadata(): bool
    {
        return $this->stripMetadata;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function getContentType(): ?string
    {
        return $this->mimeType;
    }

    public function getIdempotencyKey(): ?string
    {
        return $this->idempotencyKey;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'format' => $this->format,
            'quality' => $this->quality,
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
            'max_dimension' => $this->maxDimension,
            'fit' => $this->fit,
            'lossless' => $this->lossless,
            'strip_metadata' => $this->stripMetadata,
        ];
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromArray(array $options): self
    {
        return new self(
            (string)($options['format'] ?? ImageFormat::AUTO),
            isset($options['quality']) ? (int)$options['quality'] : 80,
            isset($options['max_width']) ? (int)$options['max_width'] : (isset($options['maxWidth']) ? (int)$options['maxWidth'] : null),
            isset($options['max_height']) ? (int)$options['max_height'] : (isset($options['maxHeight']) ? (int)$options['maxHeight'] : null),
            (string)($options['fit'] ?? FitMode::COVER),
            (bool)($options['lossless'] ?? false),
            (bool)($options['strip_metadata'] ?? ($options['stripMetadata'] ?? true)),
            isset($options['filename']) ? (string)$options['filename'] : null,
            isset($options['mime_type']) ? (string)$options['mime_type'] : (isset($options['mimeType']) ? (string)$options['mimeType'] : null),
            isset($options['idempotency_key']) ? (string)$options['idempotency_key'] : (isset($options['idempotencyKey']) ? (string)$options['idempotencyKey'] : null),
            isset($options['max_dimension']) ? (int)$options['max_dimension'] : (isset($options['maxDimension']) ? (int)$options['maxDimension'] : null)
        );
    }
}
