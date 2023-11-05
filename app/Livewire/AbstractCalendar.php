<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Traits\ManagesComponent;
use App\Traits\ManagesConfiguration;
use App\Traits\ManagesCursor;
use App\Traits\ManagesDays;
use App\Traits\ManagesEvents;
use App\Traits\ManagesGrid;
use App\Traits\ManagesHooks;
use App\Traits\ManagesLabels;
use App\Traits\ManagesMonths;
use App\Traits\ManagesView;
use App\Traits\ManagesWeeks;
use App\Traits\ManagesYears;
use Livewire\Component;

abstract class AbstractCalendar extends Component
{
    use ManagesComponent;
    use ManagesConfiguration;
    use ManagesCursor;
    use ManagesDays;
    use ManagesEvents;
    use ManagesGrid;
    use ManagesHooks;
    use ManagesLabels;
    use ManagesMonths;
    use ManagesView;
    use ManagesWeeks;
    use ManagesYears;
}
