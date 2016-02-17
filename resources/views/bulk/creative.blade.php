<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="well">
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="">

                        <form id="order-form" class="smart-form" action="{{URL::route('creative_bulk_update')}}"
                              method="post" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <header>
                                General Information
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-2">
                                        <label class="label" for=""> Name</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="name" placeholder="Name" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label" for="">Domain Name</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="advertiser_domain_name" placeholder="Domain Name" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label for="" class="label">Status</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="active">
                                            <i></i>
                                        </label>
                                    </section>

                                    <section class="col col-2">
                                        <label for="" class="label">Ad Type</label>
                                        <label class="select"><i></i>
                                            <select name="ad_type">
                                                <option value="0">Select One</option>
                                                <option value="IFRAME">IFrame</option>
                                                <option value="JAVASCRIPT">Javascript</option>
                                                <option value="XHTML_BANNER_AD">XHTML Banner Ad</option>
                                                <option value="XHTML_TEXT_AD">XHTML Text Ad</option>

                                            </select>
                                        </label>
                                    </section>

                                </div>
                            </fieldset>
                            <header>
                                URL infromation
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label" for="">Ad Tag</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="ad_tag" placeholder="Ad Tag" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Landign Page URL</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="landing_page_url" placeholder="Landign Page URL" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Width</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="size_width" placeholder="Width" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Height</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="size_height" placeholder="Height" readonly>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label" for="">Attributes</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="attributes" placeholder="Attributes" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label" for="">Preview URL</label>
                                        <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                            <input type="text" name="preview_url" placeholder="Preview URL" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">API</label>
                                        <label class="select select-multiple">
                                            <select name="api[]" multiple class="custom-scroll">
                                                <option value="VPAID_1.0">VPAID 1.0</option>
                                                <option value="VPAID_2.0">VPAID 2.0</option>
                                                <option value="MRAID-1"> MRAID-1</option>
                                                <option value="ORMMA">ORMMA</option>
                                                <option value="MRAID-2">MRAID-2</option>
                                            </select> </label>

                                        <div class="note">
                                            <strong>Note:</strong> hold down the ctrl/cmd button to select multiple
                                            options.
                                        </div>
                                    </section>

                                </div>
                                <section>
                                    <label class="label" for="">Description</label>
                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                        <textarea rows="5" name="description"
                                                  placeholder="Tell us about your Creative"></textarea>
                                    </label>
                                </section>
                            </fieldset>
                            <div class="well col-md-12">
                                @foreach($creative_obj as $index)
                                    <div class="col-md-2">
                                        <section>
                                            <label class="checkbox">
                                                <input type="checkbox" name="creative[]" value="{{$index->id}}">
                                                <i></i> {{$index->name}}
                                            </label>
                                        </section>
                                    </div>
                                @endforeach
                            </div>

                            <footer>
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-3">
                                        <button type="submit"
                                                class=" button button--antiman button--round-l button--text-medium">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
        <!-- END COL -->
    </div>
    <!-- END ROW -->
</section>
