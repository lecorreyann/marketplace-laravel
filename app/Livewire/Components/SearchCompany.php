<?php

namespace App\Livewire\Components;;

use App\Livewire\Forms\SearchValueForm;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;

class SearchCompany extends Component
{
  public SearchValueForm $form;
  public string $id;
  public string|null $name;
  public string|null $class;
  public string $label;
  public string $placeholder;
  public string|null $optionTextTopLeft; // the text to display on the top left of the option
  public string|null $optionTextBottomLeft; // the text to display on the bottom left of the option
  public string|null $optionTextTopRight; // the text to display on the top right of the option
  public string|null $optionTextBottomRight; // the text to display on the bottom right of the option
  public string $optionValue; // the field to use for the option value
  public Collection|null $options;
  public Collection|null $disabledOptions;
  public bool|null $disabled;
  public string $country; // the page of the search results
  public int|null $page; // the page of the search results
  public string|null $resultsPerPage; // the number of results per page
  public bool|null $infiniteScroll; // activate infinite scroll

  public function mount(
    $id,
    $label,
    $placeholder,
    $optionValue,
    $country,
    $name = null,
    $class = null,
    $options = null,
    $disabledOptions = null,
    $disabled = false,
    $optionTextTopLeft = null,
    $optionTextBottomLeft = null,
    $optionTextTopRight = null,
    $optionTextBottomRight = null,
    $page = 1,
    $resultsPerPage = 10,
    $infiniteScroll = true
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->class = $class;
    $this->label = $label;
    $this->options = $options ? $options : collect([]);
    $this->optionTextTopLeft = $optionTextTopLeft;
    $this->optionTextBottomLeft = $optionTextBottomLeft;
    $this->optionTextTopRight = $optionTextTopRight;
    $this->optionTextBottomRight = $optionTextBottomRight;
    $this->optionValue = $optionValue;
    $this->placeholder = $placeholder;
    $this->disabled = $disabled;
    $this->disabledOptions = $disabledOptions ? $disabledOptions : collect([]);
    $this->country = $country;
    $this->page = $page;
    $this->resultsPerPage = $resultsPerPage;
    $this->infiniteScroll = $infiniteScroll;
  }


  public function render()
  {
    return view('livewire.components.search-company');
  }


  public function updatedFormSearchValue()
  {
    // reset page
    $this->page = 1;

    // reset options
    $this->options = collect([]);

    $this->search();
  }

  #[On('search')]
  public function search()
  {


    switch ($this->country) {
      case 'France':
        $value = urlencode($this->form->searchValue);
        // search companies in France with endpoint https://recherche-entreprises.api.gouv.fr/search?q=$value&minimal=false
        $endpoint = "https://recherche-entreprises.api.gouv.fr/search?q=$value&minimal=false&page=$this->page&per_page=$this->resultsPerPage";
        // set the option value to siren
        $this->optionValue = "siren";
        // set the option top left text to nom_complet
        $this->optionTextTopLeft = "nom_complet";
        // set the option bottom left text to adresse
        $this->optionTextBottomLeft = "siege.adresse";
        // set the option top right text to siege.siret
        $this->optionTextTopRight = "siege.siret";
        // set the option bottom right text to dirigeant
        $this->optionTextBottomRight = "dirigeant";
        break;
      default:
        break;
    }
    if ($endpoint) {
      $response = Http::get($endpoint);

      // format the response to match the options format
      if (isset($response->json()['results'])) {

        // merge the options
        $this->options = $this->options->merge(collect($response->json()['results'])->map(function ($option) {

          // transform the option to a flat array
          $option = Arr::dot($option);
          // set id to siren
          $option['id'] = $option['siren'];
          // set dirigeant to the first dirigeant
          $option['dirigeant'] = Arr::get($option, 'dirigeants.0.prenoms', '') . ' ' . Arr::get($option, 'dirigeants.0.nom', '');
          // set activated
          $option['activated'] = true;
          return $option;
        }));

        $this->dispatch('updated-options', options: $this->options);

        // increment page
        $this->page++;
      }
    }
  }
}
