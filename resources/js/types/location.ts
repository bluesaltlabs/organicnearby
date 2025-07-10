export interface Location {
  id: number;
  address: string | null;
  address_line_2: string | null;
  label: string | null;
  county: string | null;
  country: string | null;
  timezone: string | null;
  city: string | null;
  state: string | null;
  zip: string | null;
  map_icon: string | null;
  latitude: number | null;
  longitude: number | null;
  locationable_id: number;
  locationable_type: string;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

// Factory for a blank location (for forms)
export function blankLocation(): Omit<Location, 'id' | 'created_at' | 'updated_at' | 'deleted_at' | 'locationable_id' | 'locationable_type'> {
  return {
    address: '',
    address_line_2: '',
    label: '',
    county: '',
    country: '',
    timezone: '',
    city: '',
    state: '',
    zip: '',
    map_icon: '',
    latitude: null,
    longitude: null,
  };
}
  