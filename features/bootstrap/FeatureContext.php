<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    const SORRY_CANNOT_CONTINUE                         = "Sorry, cannot continue.\n";
    const SORRY_TEST_FAILED                             = "Sorry, the test FAILED";
    const CANNOT_READ_FILE                              = "Cannot read '%s'. ";
    const CANNOT_CREATE_SYMLINK                         = "Cannot create symlink '%s' -> '%s'. ";
    const CANNOT_READ_DATA_FROM_SYMLINK                 = "Cannot read data from symlink '%s'. ";
    const CANNOT_RE_CREATE_SYMLINK                      = "Cannot re-create symlink '%s'. ";
    const COMMAND_S_DID_NOT_RESULT_IN_OUTPUT_CONTAINING = "Command '%s' did not result in output containing '%s'. ";

    private $provinceId;

    private $roomAmount;

    private $command;

    private $output;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        if (!defined('FEATURE_CONTEXT_PATH')) {
            define('FEATURE_CONTEXT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
        }

        if (!defined('APPLICATION_ROOT_DIR')) {
            define('APPLICATION_ROOT_DIR', dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR);
        }
    }

    /**
     * @Given I have a symbolic link :arg1 to a file named :arg2
     *
     * @param $symlinkName
     * @param $fileName
     *
     * @throws Exception
     */
    public function iHaveASymbolicLinkToAFileNamed($symlinkName, $fileName)
    {
        if ($fileName[0] === '/') {
            $fqFileName = $fileName;
        } else {
            $fqFileName = APPLICATION_ROOT_DIR . $fileName;
        }

        if ($symlinkName[0] === '/') {
            $fqSymlinkName = $symlinkName;
        } else {
            $fqSymlinkName = APPLICATION_ROOT_DIR . $symlinkName;
        }

        if (file_exists($fqSymlinkName)) {
            if (!unlink($fqSymlinkName)) {
                throw new \Exception(sprintf(self::CANNOT_RE_CREATE_SYMLINK . self::SORRY_CANNOT_CONTINUE, $fqSymlinkName));
            }
        }

        if (!is_readable($fqFileName)) {
            throw new \Exception(sprintf(self::CANNOT_READ_FILE . self::SORRY_CANNOT_CONTINUE, $fqFileName));
        }

        if (!symlink($fqFileName, $fqSymlinkName)) {
            throw new \Exception(sprintf(self::CANNOT_CREATE_SYMLINK . self::SORRY_CANNOT_CONTINUE), $fqSymlinkName, $fqFileName);
        }

        if (!is_readable($fqSymlinkName)) {
            throw new \Exception(sprintf(self::CANNOT_READ_DATA_FROM_SYMLINK . self::SORRY_CANNOT_CONTINUE), $fqSymlinkName);
        }
    }

    /**
     * @Given I have a province identifier of :arg1
     *
     * @param $provinceId
     */
    public function iHaveAProvinceIdentifierOf($provinceId)
    {
        $this->provinceId = $provinceId;
    }

    /**
     * @Given for a real estate I have a room amount of :arg1
     *
     * @param $roomAmount
     */
    public function forARealEstateIHaveARoomAmountOf($roomAmount)
    {
        $this->roomAmount = $roomAmount;
    }

    /**
     * @When I run interactively :arg1
     *
     * @param $command
     */
    public function iRunInteractively($command)
    {
        $output        = null;
        $this->command = sprintf("echo %s, %s | php %s ", $this->provinceId, $this->roomAmount, $command);
        exec($this->command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /**
     * @Then I should see :arg1 in the output
     *
     * @param $probe
     *
     * @throws Exception
     */
    public function iShouldSeeInTheOutput($probe)
    {
        if (mb_stripos($this->output, $probe) === false) {
            throw new \Exception(sprintf(self::COMMAND_S_DID_NOT_RESULT_IN_OUTPUT_CONTAINING . self::SORRY_TEST_FAILED, $this->command, $probe));
        }
    }
}
