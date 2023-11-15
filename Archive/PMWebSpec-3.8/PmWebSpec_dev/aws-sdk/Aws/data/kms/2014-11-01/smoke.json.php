<?php
// This file was auto-generated from sdk-root/src/data/kms/2014-11-01/smoke.json
return [ 'version' => 1, 'defaultRegion' => 'us-west-2', 'testCases' => [ [ 'operationName' => 'ListAliases', 'input' => [], 'errorExpectedFromService' => false, ], [ 'operationName' => 'GetKeyPolicy', 'input' => [ 'KeyId' => 'keyid', 'PolicyName' => 'fakePolicy', ], 'errorExpectedFromService' => true, ], ],];
