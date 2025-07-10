export interface Farm {
  id: number;
  slug: string;
  name: string;
  description: string | null;
  phone: string | null;
  email: string | null;
  is_approved: boolean;
  logo_url: string | null;
  website_url: string | null;
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
  user_id?: number | null;
}

// Factory for a blank farm (for forms)
export function blankFarm(): Omit<Farm, 'id' | 'created_at' | 'updated_at' | 'deleted_at' | 'user_id'> {
  return {
    slug: '',
    name: '',
    description: '',
    phone: '',
    email: '',
    is_approved: false,
    logo_url: '',
    website_url: '',
  };
}
