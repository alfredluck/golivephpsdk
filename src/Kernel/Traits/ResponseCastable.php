<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Golivephpsdk\Kernel\Traits;

use Golivephpsdk\Kernel\Contracts\Arrayable;
use Golivephpsdk\Kernel\Exceptions\InvalidArgumentException;
use Golivephpsdk\Kernel\Exceptions\InvalidConfigException;
use Golivephpsdk\Kernel\Http\Response;
use Golivephpsdk\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait ResponseCastable.
 *
 * @author overtrue <i@overtrue.me>
 */
trait ResponseCastable
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $type
     *
     * @return array|\Golivephpsdk\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Golivephpsdk\Kernel\Exceptions\InvalidConfigException
     */
    protected function castResponseToType(ResponseInterface $response, $type = null)
    {
        $response = Response::buildFromPsrResponse($response);
        $response->getBody()->rewind();

        switch ($type ?? 'array') {
            case 'collection':
                return $response->toCollection();
            case 'array':
                return $response->toArray();
            case 'object':
                return $response->toObject();
            case 'raw':
                return $response;
            default:
                if (!is_subclass_of($type, Arrayable::class)) {
                    throw new InvalidConfigException(sprintf('Config key "response_type" classname must be an instanceof %s', Arrayable::class));
                }

                return new $type($response);
        }
    }

    /**
     * @param mixed       $response
     * @param string|null $type
     *
     * @return array|\Golivephpsdk\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Golivephpsdk\Kernel\Exceptions\InvalidArgumentException
     * @throws \Golivephpsdk\Kernel\Exceptions\InvalidConfigException
     */
    protected function detectAndCastResponseToType($response, $type = null)
    {
        switch (true) {
            case $response instanceof ResponseInterface:
                $response = Response::buildFromPsrResponse($response);

                break;
            case $response instanceof Arrayable:
                $response = new Response(200, [], json_encode($response->toArray()));

                break;
            case ($response instanceof Collection) || is_array($response) || is_object($response):
                $response = new Response(200, [], json_encode($response));

                break;
            case is_scalar($response):
                $response = new Response(200, [], (string) $response);

                break;
            default:
                throw new InvalidArgumentException(sprintf('Unsupported response type "%s"', gettype($response)));
        }

        return $this->castResponseToType($response, $type);
    }
}
