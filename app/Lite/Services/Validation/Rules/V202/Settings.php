<?php namespace App\Lite\Services\Validation\Rules\V202;

use App\Core\V201\Traits\GetCodes;
use App\Models\Organization\Organization;

/**
 * Class Settings
 * @package App\Lite\Services\Validation\Rules\V202
 */
class Settings
{
    use GetCodes;
    /**
     * @var array
     */
    protected $settingsRules = [];

    /**
     * @var array
     */
    protected $methods = [
        'OrganisationName',
        'Language',
        'OrganisationNameAbbreviation',
        'Country',
        'OrganisationRegistrationAgency',
        'OrganisationRegistrationNumber',
        'OrganisationType',
        'OrganisationIatiIdentifier',
        'PublisherId',
        'ApiKey',
        'DefaultCurrency',
        'DefaultLanguage'
    ];

    /**
     * @var array
     */
    protected $settingsMessages = [];

    /**
     * @return array
     */
    public function rules()
    {
        foreach ($this->methods() as $method) {
            $methodName = sprintf('rulesFor%s', $method);

            if (method_exists($this, $methodName)) {
                $this->{$methodName}();
            }
        }

        return $this->settingsRules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        foreach ($this->methods() as $method) {
            $methodName = sprintf('messagesFor%s', $method);

            if (method_exists($this, $methodName)) {
                $this->{$methodName}();
            }
        }

        return $this->settingsMessages;
    }

    /**
     * @return array
     */
    protected function methods()
    {
        return $this->methods;
    }

    /**
     * @return $this
     */
    protected function rulesForOrganisationName()
    {
        $this->settingsRules['organisationName'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForOrganisationName()
    {
        $this->settingsMessages['organisationName.required'] = trans('validation.required', ['attribute' => trans('lite/settings.organisation_name')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForLanguage()
    {
        $this->settingsRules['language'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForLanguage()
    {
        $this->settingsMessages['language.required'] = trans('validation.required', ['attribute' => trans('lite/settings.language')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForOrganisationNameAbbreviation()
    {

        $organisationIdentifiers = Organization::select('user_identifier')->where('id', '<>', session('org_id'))->get()->toArray();
        $organisationId          = [];
        foreach ($organisationIdentifiers as $organisationIdentifier) {
            $organisationId[] = getVal($organisationIdentifier, ['user_identifier'], '');
        }

        $this->settingsRules['organisationNameAbbreviation'] = sprintf('required|not_in:%s', implode(",", $organisationId));

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForOrganisationNameAbbreviation()
    {
        $this->settingsMessages['organisationNameAbbreviation.required'] = trans('validation.required', ['attribute' => trans('lite/settings.organisation_name_abbreviation')]);
        $this->settingsMessages['organisationNameAbbreviation.not_in']   = trans('validation.not_in', ['attribute' => trans('lite/settings.organisation_name_abbreviation')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForCountry()
    {
        $this->settingsRules['country'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForCountry()
    {
        $this->settingsMessages['country.required'] = trans('validation.required', ['attribute' => trans('lite/settings.country')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForOrganisationRegistrationAgency()
    {
        $this->settingsRules['organisationRegistrationAgency'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForOrganisationRegistrationAgency()
    {
        $this->settingsMessages['organisationRegistrationAgency.required'] = trans('validation.required', ['attribute' => trans('lite/settings.organisation_registration_agency')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForOrganisationRegistrationNumber()
    {
        $this->settingsRules['organisationRegistrationNumber'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForOrganisationRegistrationNumber()
    {
        $this->settingsMessages['organisationRegistrationNumber.required'] = trans('validation.required', ['attribute' => trans('lite/settings.organisation_registration_number')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForOrganisationIatiIdentifier()
    {
        $organisationIdentifiers = Organization::select('reporting_org')->where('id', '<>', session('org_id'))->get()->toArray();
        $organisationId          = [];
        foreach ($organisationIdentifiers as $organisationIdentifier) {
            $organisationId[] = getVal($organisationIdentifier, ['reporting_org', 0, 'reporting_organization_identifier'], '');
        }

        $this->settingsRules['organisationIatiIdentifier'] = sprintf('required|not_in:%s', implode(",", $organisationId));

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForOrganisationIatiIdentifier()
    {
        $this->settingsMessages['organisationIatiIdentifier.required'] = trans('validation.required', ['attribute' => trans('lite/settings.organisation_identifier')]);
        $this->settingsMessages['organisationIatiIdentifier.not_in']   = trans('validation.not_in', ['attribute' => trans('lite/settings.organisation_identifier')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForOrganisationType()
    {
        $this->settingsRules['organisationType'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForOrganisationType()
    {
        $this->settingsMessages['organisationType.required'] = trans('validation.required', ['attribute' => trans('lite/settings.organisation_type')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForDefaultCurrency()
    {
        $this->settingsRules['defaultCurrency'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForDefaultCurrency()
    {
        $this->settingsMessages['defaultCurrency.required'] = trans('validation.required', ['attribute' => trans('lite/settings.default_currency')]);

        return $this;
    }

    /**
     * @return $this
     */
    protected function rulesForDefaultLanguage()
    {
        $this->settingsRules['defaultLanguage'] = 'required';

        return $this;
    }

    /**
     * @return $this
     */
    protected function messagesForDefaultLanguage()
    {
        $this->settingsMessages['defaultLanguage.required'] = trans('validation.required', ['attribute' => trans('lite/settings.default_language')]);

        return $this;
    }
}
