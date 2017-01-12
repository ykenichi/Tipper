# Pre-work - *Tipper*

**Tipper** is a tip calculator PHP page.

Submitted by: **Kenichi Yamamoto**

Time spent: **8** hours spent in total

## User Stories

The following **required** functionality is complete:
* [x] User can enter a bill amount, choose a tip percentage, and submit the form to see the tip and total values.
* [x] Tip percentage choices use a PHP loop to output three radio buttons.
* [x] PHP code sets reasonable default values for the form.
* [x] PHP code confirms the presence and correct format of submitted values.
* [x] Page indicates any form errors which need to be fixed.
* [x] Submitted form values are retained when errors or results are shown.

The following **optional** features are implemented:
* [x] Add support for custom tip percentage
* [x] Add support for splitting the tip and total

The following **additional** features are implemented:

* [ ] List anything else that you can get done to improve the functionality!

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='http://imgur.com/a/oFT6s' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

One of the challenges encountered when making the app was trying to get the values set by the user to remain the same after an error occurs. This was accomplished by using php variables to hold the values of the different fields.

Another challenge was figuring out how to show/hide the sections that contained the total tip as well as the split tip. This was accomplished using booleans within the css of each div box to set the display to block or none in order to show or hide each section, respectively.

## License

    Copyright 2017 Kenichi Yamamoto

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
