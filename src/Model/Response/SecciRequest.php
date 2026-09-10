<?php

/*
 * Copyright (c) Ratepay GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RatePAY\Model\Response;

class SecciRequest extends AbstractResponse
{
    /**
     * Validates response.
     */
    public function validateResponse()
    {
        if ($this->getStatusCode() == 'OK' && $this->getResultCode() == 504) {
            $this->setResult(['attestationToken' => (string)$this->getResponse()->content->{'secci-result'}->{'attestation-token'}]);
            $this->setResult(['documentId' => (string)$this->getResponse()->content->{'secci-result'}->{'document-id'}]);
            if (isset($this->getResponse()->content->{'secci-result'}->{'document'})) {
                $this->setResult(['document' => (string)$this->getResponse()->content->{'secci-result'}->{'document'}]);
                $this->setResult(['contentType' => (string)$this->getResponse()->content->{'secci-result'}->{'content-type'}]);
            }
            $this->setSuccessful();
        }
    }

    /**
     * Returns attestation token.
     *
     * @return string|null
     */
    public function getAttestationToken()
    {
        return (key_exists('attestationToken', $this->result)) ? $this->result['attestationToken'] : null;
    }

    /**
     * Returns document id.
     *
     * @return string|null
     */
    public function getDocumentId()
    {
        return (key_exists('documentId', $this->result)) ? $this->result['documentId'] : null;
    }

    /**
     * Returns document.
     *
     * @return string|null
     */
    public function getDocument()
    {
        return (key_exists('document', $this->result)) ? $this->result['document'] : null;
    }

    /**
     * Returns content type of the document.
     *
     * @return string|null
     */
    public function getContentType()
    {
        return (key_exists('contentType', $this->result)) ? $this->result['contentType'] : null;
    }
}
